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
        return parent::install() && $this->installSql();
    }


    public function uninstall()
    {
        return parent::uninstall() && $this->uninstallSql();
    }

    private function installSql()
    {

        $sql = '
            CREATE TABLE `' . pSQL(_DB_PREFIX_) . 'city_list` (
            `id_citylist` INT AUTO_INCREMENT NOT NULL,
            `id_country` INT NOT NULL,
            `city_name` VARCHAR(64) NOT NULL,
            `active` TINYINT(1) NOT NULL,
            PRIMARY KEY(id_citylist))
            DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE =' . pSQL(_MYSQL_ENGINE_) . ';
            ';

        return DB::getInstance()->execute($sql);
    }


    private function uninstallSql()
    {
        $sql = 'DROP TABLE IF EXISTS `' . pSQL(_DB_PREFIX_) . 'city_list`';

        return Db::getInstance()->execute($sql);
    }
}