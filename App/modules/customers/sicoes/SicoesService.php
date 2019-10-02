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
        $html = new simple_html_dom();
        $html->load_file(PUBLIC_DIR . 'test_sicoes2.html');

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

        $tablePrecio = $tablesDetalles[4];
        $trsPrecio = $tablePrecio->find("table>tbody>tr");

        foreach ($trsPrecio as $tr) {
            $tds = $tr->find("td");
            if (sizeof($tds) >= 8 && $tds[0]->plaintext != '#') {
                $labelTd = strtoupper($tds[5]);
                $cantidad = str_replace(",", "", trim($tds[5]->plaintext)) * 1;
                $precioUnidad = str_replace(",", "", trim($tds[6]->plaintext)) * 1;
                $data['NUMERO_CONSULTORES'] = $cantidad;
                $data['PRECIO_UNITARIO'] = $precioUnidad;
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

        $sicoes = new JobSicoesConvocatoria();
        $sicoes->setCuce($data['CUCE']);
        $sicoes->setCodigoSisin('');
        $sicoes->setObjetoLicitacion($data['LICITACION']);
        $sicoes->setNombreEntidad($data['NOMBRE_ENTIDAD']);
        $sicoes->setCodigoEntidad($data['CODIGO_ENTIDAD']);
        $sicoes->setTelefonoEntidad($data['TELEFONO_ENTIDAD']);
        $sicoes->setFechaPublicacion($data['FECHA_PUBLICACION']);
        $sicoes->setFechaLimite($data['FECHA_LIMITE']);
        $sicoes->setEstado($data['ESTADO']);
        $sicoes->setModalidad($data['MODALIDAD']);
        $sicoes->setTipoConvocatoria($data['TIPO_CONVOCATORIA']);
        $sicoes->setTipoConsultoria($data['TIPO_CONSULTORIA']);
        $sicoes->setFormaAdjudicacion($data['FORMA_ADJUDICACION']);
        $sicoes->setTipoContratacion($data['TIPO_CONTRATACION']);
        $sicoes->setGarantiasSolicitadas($data['GARANTIAS_SOLICITADAS']);
        $sicoes->setNumeroConsultores($data['NUMERO_CONSULTORES']);
        $sicoes->setPrecioUnitario($data['PRECIO_UNITARIO']);
        $sicoes->setEnlace();
        $sicoes->setDepartamento($data['DEPARTAMENTO']);
        $sicoes->setContacto($data['CONTACTO']);
        $sicoes->setStatus();
//        $sicoes->save();
        echo "" . $sicoes->toJson();

        file_put_contents(PUBLIC_DIR . "test-sicoes.json", $sicoes->toJson());
        exit();
    }

}