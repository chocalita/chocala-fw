<?php
Chocala::import('Model.utils.simple_html_dom');

/**
 * Description of SicoesController
 *
 * @author ypra
 * @date 5/5/2019
 * @time 14:38
 */
class SicoesService extends AppSecureService
{

    /**
     * @var SicoesService
     */
    protected static $instance = null;

    /**
     * @return JobSicoesConvocatoriaQuery
     */
    public function validsQuery($noDeletes = true)
    {
        return JobSicoesConvocatoriaQuery::createValids($noDeletes);
    }

    /**
     * @param $pk
     * @return array|mixed|JobSicoesConvocatoria
     * @throws ChocalaException
     */
    public function findPk($pk)
    {
        $sicoes = $this->validsQuery()->findPk($pk);
        if (!is_object($sicoes)) {
            throw new ChocalaException(ChocalaErrors::INVALID_RESOURCE);
        }
        return $sicoes;
    }

    /**
     * @param array $filters
     * @return JobSicoesConvocatoria[]|\Propel\Runtime\Util\PropelModelPager
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function dataList($filters = [])
    {
        $orders = $filters['_order'] ?: ['FechaLimite' => Criteria::DESC];
        $query = $this->validsQuery()
//            ->_if(isset($filters['_fechaVigencia']))
//            ->filterVigentes($filters['_fechaVigencia'])
//            ->_endif()
//            ->_if(isset($filters['_fechaNoVigencia']))
//            ->filterVigentes($filters['_fechaNoVigencia'], false)
//            ->_endif()
//            ->_if(isset($filters['empresaSuscrita']))
//            ->filterByJobEmpresaSuscrita($filters['empresaSuscrita'])
//            ->_endif()
//            ->_if(isset($filters['cargo']))
//            ->filterByCargo('%' . $filters['cargo'] . '%', Criteria::ILIKE)
//            ->_endif()
//            ->_if(isset($filters['descripcion']))
//            ->filterByDescripcion('%' . $filters['descripcion'] . '%', Criteria::ILIKE)
//            ->_endif()
//            ->_if(isset($filters['nombreEmpresa']))
//            ->filterByNombreEmpresa('%' . $filters['nombreEmpresa'] . '%', Criteria::ILIKE)
//            ->_endif()
//            ->_if(isset($filters['nivelFormacion']))
//            ->filterByNivelFormacion($filters['nivelFormacion'], Criteria::EQUAL)
//            ->_endif()
//            ->_if(isset($filters['profesion']))
//            ->filterByProfesion('%' . $filters['profesion'] . '%', Criteria::ILIKE)
//            ->_endif()
            ->_if(isset($filters['status']))
            ->filterByStatus($filters['status'], Criteria::EQUAL)
            ->_endif()
            ->orders($orders);
        $_page = $filters['_page'] ?: 1;
        $_max = $filters['_max'] ?: $query->count();
        return $query->paginate($_page, $_max);
    }

    public function asas_viz()
    {
        $fileName = $_GET['fileName'];
        $keys = [];
        $i = 0;
        $originalContent = file_get_contents(PUBLIC_DIR . "cycle_count_1.csv");
        $lines = explode("\n", $originalContent);
        echo "Parts -> " . sizeof($lines);
        $finalContent = '';
        foreach ($lines as $line) {
//            if ($i < 10000) {
//                $lineParts = explode(",", $line);
            $serial = trim($line);
            if (strpos($serial, "CreateTime") === false) {
//                    if (!in_array($serial, $keys)) {
                $i++;
                $finalContent .= $serial . "\n";
//                        array_push($keys, $serial);
                if (($i % 5000) == 0) {
                    echo "<br> $i - Serial -> " . $serial;
                }
//                    }
//                }
            }
        }
//        foreach ($keys as $key) {
//            $finalContent.= $key . "\n";
//        }
        file_put_contents(PUBLIC_DIR . "final_cycle_count.csv" . $fileName, $finalContent);
        exit();
    }

    public function asas000()
    {
        $fileName = $_GET['fileName'];
        $keys = [];
        $i = 0;
//        $originalContent = file_get_contents(PUBLIC_DIR . "cycle_count.logs");
        $originalContent = file_get_contents(PUBLIC_DIR . $fileName);
        $lines = explode("\n", $originalContent);
        echo "Parts -> " . sizeof($lines);
        foreach ($lines as $line) {
//            if ($i < 10000) {
            $lineParts = explode(",", $line);
            $serial = trim($lineParts[0]);
            if (strpos($serial, "CreateTime") === false) {
                if (!in_array($serial, $keys)) {
                    $i++;
                    array_push($keys, $serial);
                    if (($i % 5000) == 0) {
                        echo "<br> $i - Serial -> " . $serial;
                    }
                }
//                }
            }
        }
        $finalContent = '';
        foreach ($keys as $key) {
            $finalContent .= $key . "\n";
        }
        file_put_contents(PUBLIC_DIR . "final_cycle_count.csv" . $fileName, $finalContent);
        exit();
    }

    public function asas()
    {

        $url = "https://www.infosicoes.com/descom-fi-const-sist-agua-potable-com-tierra-firme-san-ignacio-c-san-ignacio-de-vela--lct393781.html";
        $handler = curl_init($url);
        curl_setopt($handler, CURLOPT_POST, 1);
        curl_setopt($handler, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($handler,CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($handler);
//        echo $response; exit();
        curl_close($handler);
        file_put_contents(PUBLIC_DIR . 'page-02.html', $response);

        $this->readFile();
    }

    public function readFile()
    {
        $html = new simple_html_dom();
        $html->load_file(PUBLIC_DIR . 'page-02.html');

//        $htmlPage = file_get_contents(PUBLIC_DIR . 'test_sicoes.html');
//        $htmlDom = str_get_html($htmlPage);
//        $htmlDom = $html;
        $nodeLicitacionDiv = $html->find('div[class=licitacion]');
        $tableTrs = $nodeLicitacionDiv[0]->find('table[class=licitacion-tabla1] tr');
        $data = [];
        foreach ($tableTrs as $tr) {
            $tds = $tr->find("td");
            $types = $tds[0]->find("b");
            $type = strtoupper(trim(str_replace(":", "", $types[0]->plaintext)));
            $value = trim($tds[1]->plaintext);
            $data[$type] = $value;
//            echo "<br />".$type . " : " . $value;
        }

        $tablesLicitacion = $html->find("div[class=bx-licitacion] table table table");
        $tableEntidad = $tablesLicitacion[1];
        $tdsEntidad = $html->find("tr[class=FormularioDatoCentreado] td");
        $data['CODIGO_ENTIDAD'] = trim(str_replace("&nbsp;", "", $tdsEntidad[0]->plaintext));
        $data['NOMBRE_ENTIDAD'] = trim(str_replace("&nbsp;", "", $tdsEntidad[1]->plaintext));
        $data['TELEFONO_ENTIDAD'] = trim(str_replace("&nbsp;", "", $tdsEntidad[3]->plaintext));


        $tablesDetalles = $html->find("div[class=bx-licitacion]>table");
        $tdsIdentificacion = $tablesDetalles[2]->find("table td");

        $data['CUCE'] = trim(str_replace("&nbsp;", "", $tdsIdentificacion[2]->plaintext));
        $fechaPublicacion = trim(str_replace("&nbsp;", "", $tdsIdentificacion[5]->plaintext));
        $data['FECHA_PUBLICACION'] = DateUtil::createFromFormat('d/m/Y', $fechaPublicacion);
        $data['LICITACION'] = trim(str_replace("&nbsp;", "", $tdsIdentificacion[8]->plaintext));

        $tableDatosGenerales = $tablesDetalles[3];

        $trsDatosGenerales = $tableDatosGenerales->find("td>table>tbody>tr");
        foreach ($trsDatosGenerales as $tr) {
            $tds = $tr->find("td");
            $labelTd = strtoupper($tds[0]->plaintext);
            echo "<br>" . $labelTd;
            if (strpos($labelTd, "TIPO DE CONVOCA") > -1) {
                $data['TIPO_CONVOCATORIA'] = trim(str_replace("&nbsp;", "", $tds[2]->plaintext));
            }
            if (strpos($labelTd, "TIPO DE CONTRATA") > -1) {
                $data['TIPO_CONTRATACION'] = trim(str_replace("&nbsp;", "", $tds[2]->plaintext));
            }
            if (strpos($labelTd, "CONSULTOR") > -1) {
                $data['TIPO_CONSULTORIA'] = trim(str_replace("&nbsp;", "", $tds[2]->plaintext));
            }
            if (strpos($labelTd, "FORMA DE ADJUDI") > -1) {
                $data['FORMA_ADJUDICACION'] = trim(str_replace("&nbsp;", "", $tds[2]->plaintext));
            }
            if (strpos($labelTd, "SOLICITADAS") > -1) {
                $data['GARANTIAS_SOLICITADAS'] = trim(str_replace("&nbsp;", "", $tds[2]->plaintext));
            }
        }

//        echo "<br /> P - " . $trsPrecio->plaintext;

//        $data['TIPO_CONSULTORIA'] = trim(str_replace("&nbsp;", "", $tdsEntidad[3]->plaintext));
//        $data['PRECIO_UNITARIO'] = trim(str_replace("&nbsp;", "", $tdsDetalles[4]->plaintext)) * 1;
//        echo $tdsDetalles;


        $tableProgramacion = $tablesDetalles[8];
        $trsProgramacion = $tableProgramacion->find("table tr[class=FormularioDato]");
        foreach ($trsProgramacion as $tr) {
            $tds = $tr->find("td");
            $labelTd = strtoupper($tds[1]->plaintext);
            if (strpos($labelTd, "DE PROPUESTAS") > -1) {
                $fechaLimite = trim(str_replace("&nbsp;", "", $tds[2]->plaintext));
                $data['FECHA_LIMITE'] = DateUtil::createFromFormat('d/m/Y', $fechaLimite);
            }
        }

        echo "<br />==== CONTENT ====================================<br />";
        echo $nodeLicitacionDiv[0];

        $sicoesConvocatoria = new JobSicoesConvocatoria();
        $sicoesConvocatoria->setCuce($data['CUCE']);
        $sicoesConvocatoria->setCodigoSisin('');
        $sicoesConvocatoria->setObjetoLicitacion($data['LICITACION']);
        $sicoesConvocatoria->setNombreEntidad($data['NOMBRE_ENTIDAD']);
        $sicoesConvocatoria->setCodigoEntidad($data['CODIGO_ENTIDAD']);
        $sicoesConvocatoria->setTelefonoEntidad($data['TELEFONO_ENTIDAD']);
        $sicoesConvocatoria->setFechaPublicacion($data['FECHA_PUBLICACION']);
        $sicoesConvocatoria->setFechaLimite($data['FECHA_LIMITE']);
        $sicoesConvocatoria->setEstado($data['ESTADO']);
        $sicoesConvocatoria->setModalidad($data['MODALIDAD']);
        $sicoesConvocatoria->setTipoConvocatoria($data['TIPO_CONVOCATORIA']);
        $sicoesConvocatoria->setTipoConsultoria($data['TIPO_CONSULTORIA']);
        $sicoesConvocatoria->setFormaAdjudicacion($data['FORMA_ADJUDICACION']);
        $sicoesConvocatoria->setTipoContratacion($data['TIPO_CONTRATACION']);
        $sicoesConvocatoria->setGarantiasSolicitadas($data['GARANTIAS_SOLICITADAS']);
        $sicoesConvocatoria->setEnlace();
        $sicoesConvocatoria->setDepartamento($data['DEPARTAMENTO']);
        $sicoesConvocatoria->setContacto($data['CONTACTO']);
        $sicoesConvocatoria->setStatus("ACTIVE");

        $tablePrecio = $tablesDetalles[4];
        $trsPrecio = $tablePrecio->find("table>tbody>tr");

        foreach ($trsPrecio as $tr) {
            $tds = $tr->find("td");
            if (sizeof($tds) >= 8 && $tds[0]->plaintext != '#') {
                $numeroDetalle = str_replace(",", "", trim($tds[0]->plaintext)) * 1;
                $codigoCatalogo = str_replace(",", "", trim($tds[1]->plaintext));
                $objetoGasto = str_replace(",", "", trim($tds[2]->plaintext));
                $descripcionDetalle = str_replace(",", "", trim($tds[3]->plaintext));
                $unidadMedida = str_replace(",", "", trim($tds[4]->plaintext));
                $cantidad = str_replace(",", "", trim($tds[5]->plaintext)) * 1;
                if ($cantidad > 0) {
                    $precioUnitario = str_replace(",", "", trim($tds[6]->plaintext)) * 1;
                    $data['NUMERO'] = $numeroDetalle;
                    $data['DESCRIPCION'] = $descripcionDetalle;
                    $data['UNIDAD_MEDIDA'] = $unidadMedida;
                    $data['CANTIDAD'] = $cantidad;
                    $data['PRECIO_UNIDAD'] = $precioUnitario;
                    $data['CODIGO_CATALOGO'] = $codigoCatalogo;
                    $data['OBJETO_GASTO'] = $objetoGasto;

                    $sicoesDetalle = new JobSicoesDetalle();
                    $sicoesDetalle->setNumero($data['NUMERO']);
                    $sicoesDetalle->setDescripcion($data['DESCRIPCION']);
                    $sicoesDetalle->setUnidadMedida($data['UNIDAD_MEDIDA']);
                    $sicoesDetalle->setCantidad($data['CANTIDAD']);
                    $sicoesDetalle->setPrecioUnidad($data['PRECIO_UNIDAD']);
                    $sicoesDetalle->setCodigoCatalogo($data['CODIGO_CATALOGO']);
                    $sicoesDetalle->setObjetoGasto($data['OBJETO_GASTO']);
                    $sicoesDetalle->setStatus("ACTIVE");
                    $sicoesConvocatoria->addJobSicoesDetalle($sicoesDetalle);
                }
            }
        }
        $this->_logger()->info($sicoesConvocatoria->toJson());

        if ($sicoesConvocatoria->validate()) {
            $sicoesConvocatoria->save();
        } else {
            $this->_logger()->warning(json_encode($sicoesConvocatoria->getErrorsMap()));
        }


//        echo "" . $sicoesConvocatoria->toJson();

        file_put_contents(PUBLIC_DIR . "test-sicoes.json", $sicoesConvocatoria->toJson());
        file_put_contents(PUBLIC_DIR . "test-sicoes2.json", json_encode($sicoesConvocatoria->toArray()));
        exit();
    }

}