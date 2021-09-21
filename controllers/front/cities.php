<?php

class CitylistCitiesModuleFrontController extends ModuleFrontController
{

        public function initContent()
        {
            parent::initContent();
            
            $this->ajax = true;

            $sql = new DbQuery();
            $sql->select('*');
            $sql->from('city_list', 'cl');
            $sql->where('cl.active = 1');
            $json = Tools::jsonEncode(array( 'cities' => Db::getInstance()->executeS($sql)));

            header('Content-type: application/json');
            echo $json;
            // die();


            // $this->setTemplate('module:citylist/views/templates/front/test.tpl');
        }

}