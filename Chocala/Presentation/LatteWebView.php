<?php

/**
 * Description of WebView
 *
 * @author ypra
 */
class LatteWebView implements IView
{

    /**
     *
     * @var string
     */
    protected $layout = null;

    /**
     *
     * @var string
     */
    protected $module = null;

    /**
     *
     * @var string
     */
    protected $template = null;

    /**
     *
     * @var array
     */
    protected $vars = array();

    /**
     *
     * @var array
     */
    protected $errors = array();

    /**
     *
     * @var string
     */
    protected $tmp = null;

    /**
     *
     * @param array $vars
     * @return void
     */
    public function setVars($vars)
    {
        if (is_array($vars)) {
            $this->vars = $vars;
        } else {
            array_push($this->errors, "Paso de variables incorrecto");
        }
    }

    public function __construct($layout)
    {
        $this->layout = $layout;
    }

    /**
     * Change the layout for deploy the page
     * @param string $layout
     */
    public function changeLayout($layout)
    {
        $this->layout = $layout;
    }

    /**
     *
     * @param string $name
     * @param mixed $var
     * @return void
     */
    public function setVar($name, $var)
    {
        $this->vars[$name] = $var;
    }

    /**
     *
     * @param string $name
     * @return mixed
     */
    public function getVar($name)
    {
        return isset($this->vars[$name]) ? $this->vars[$name] : false;
    }

    /**
     *
     * @return string
     */
    protected function viewPath()
    {
        return ($this->module != '' &&
            ChocalaVars::asBoolean(Configs::value('app.run.modular'))) ?
            $this->module . '.' : '';
    }

    /**
     *
     * @return string
     */
    protected function layoutPath()
    {
        return '';
    }

    /**
     *
     * @return string
     */
    protected function templatePath()
    {
        return ($this->module != '' &&
            ChocalaVars::asBoolean(Configs::value('app.run.modular'))) ?
            $this->module . '.' : '';
    }

    /**
     *
     * @param string $__Content
     * @return void
     */
    public function renderLayout($__Content)
    {
        //$__Errors= $this->renderMessages();
        require_once(LAYOUTS_DIR . $this->layout . Chocala::TEMPLATE_EXTENSION);
    }

    /**
     *
     * @return string
     */
    protected function renderTemplate()
    {
        $this->tmp = str_replace('.', DIRECTORY_SEPARATOR, $this->template);
        ob_start();
        @extract($this->vars, EXTR_OVERWRITE);
        /*        if(false){
                    require_once('ViewEngine.php');
                    ViewEngine::transformTemplate($this->tmp);
                    require(TEMPLATES_DIR_C.$this->tmp."_c".
                            Chocala::TEMPLATE_EXTENSION);
                }else{
                    require(MODULES_DIR.$this->tmp.Chocala::TEMPLATE_EXTENSION);
                }
        */

        /*
        // Plates section
                $parts = explode(DIRECTORY_SEPARATOR, MODULES_DIR.$this->tmp);
                $template = array_pop($parts);
                $directory = implode(DIRECTORY_SEPARATOR, $parts);

                // Create new Plates instance
                $templates = new League\Plates\Engine($directory, "phtml");

                // Render a template
                echo $templates->render($template, $this->vars);
        */

// Latte section

//        print_r($this->vars); exit();

        $parts = explode(DIRECTORY_SEPARATOR, MODULES_DIR . $this->tmp);
        $template = array_pop($parts);
        $directory = implode(DIRECTORY_SEPARATOR, $parts);

        $latte = new Latte\Engine();
        $latte->setTempDirectory($directory);
        $parameters['items'] = array('one', 'two', 'three');
        echo $latte->render($directory.DIRECTORY_SEPARATOR.$template . "1.phtml", $this->vars);

        $htmlContent = ob_get_contents();
        ob_end_clean();
        return $htmlContent;
    }

    public function render($content)
    {
        Headers::instance()->sendHeaders();
        echo $content;
    }

    public function renderView($template, $module = null)
    {
        $this->module = $module;
        $this->template = $this->templatePath() . lcfirst($template);
        Headers::instance()->sendHeaders();
        $this->renderLayout($this->renderTemplate());
    }

    public function renderViewWithoutLayout($template, $module = null)
    {
        $this->module = $module;
        $this->template = $this->templatePath() . lcfirst($template);
        Headers::instance()->sendHeaders();
        echo $this->renderTemplate();
        exit;
    }

    public function renderViewWithoutLayoutAsString($template, $module = null)
    {
        $this->module = $module;
        $this->template = $this->templatePath() . lcfirst($template);
        return $this->renderTemplate();
    }

    public function renderJSON()
    {
        Headers::instance()->changeContentTypeTo(ContentType::TYPE_JSON);
        Headers::instance()->sendHeaders();
        foreach ($this->vars as $kVar => $vVar) {
            if ($vVar instanceof \Propel\Runtime\Util\PropelModelPager ||
                $vVar instanceof \Propel\Runtime\Collection\ObjectCollection) {
                $this->vars[$kVar] = $vVar->toArray();
            }
        }
        echo json_encode($this->vars);
    }

}