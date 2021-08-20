<?php

class Tntrunkscity extends Module
{
    public function __construct()
    {
        $this->name = 'tntrunkscity';
        $this->version = '1.0.0';
        $this->author = 'TnTrunks';
        $this->need_instance = 0;

        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = $this->getTranslator()->trans(
            'TnTrunks City',
            [],
            'Modules.Tntrunkscity.Admin'
        );

        $this->description =
            $this->getTranslator()->trans(
                'Add and display city list to address section',
                [],
                'Modules.Tntrunkscity.Admin'
            );

        $this->ps_versions_compliancy = [
            'min' => '1.7.7.0',
            'max' => _PS_VERSION_,
        ];
    }


    /**
     * This function is required in order to make module compatible with new translation system.
     *
     * @return bool
     */
    public function isUsingNewTranslationSystem()
    {
        return true;
    }



    /**
     * Install module and register hooks to allow grid modification.
     *
     * @see https://devdocs.prestashop.com/1.7/modules/concepts/hooks/use-hooks-on-modern-pages/
     *
     * @return bool
     */
    public function install()
    {
        return parent::install();;
    }


    public function uninstall()
    {
        return parent::uninstall();
    }
}