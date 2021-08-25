<?php

class Citylist extends Module
{
    public function __construct()
    {
        $this->name = 'citylist';
        $this->version = '1.0.0';
        $this->author = 'Eliphaz';
        $this->need_instance = 0;

        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = $this->getTranslator()->trans(
            'City List',
            [],
            'Modules.Citylist.Admin'
        );

        $this->description =
            $this->getTranslator()->trans(
                'Add and display city list to address section',
                [],
                'Modules.Citylist.Admin'
            );

        $this->ps_versions_compliancy = [
            'min' => '1.7.7.0',
            'max' => _PS_VERSION_,
        ];

        $tabNames = [];
        foreach (Language::getLanguages(true) as $lang) {
            $tabNames[$lang['locale']] = $this->trans('City List', array(), 'Modules.Citylist.Admin', $lang['locale']);
        }

        $this->tabs = [
            [
                'route_name' => 'city_list',
                'class_name' => 'AdminCityList',
                'visible' => true,
                'name' => $tabNames,
                'parent_class_name' => 'IMPROVE',
                'wording' => 'City List',
                'wording_domain' => 'Modules.Citylist.Admin'
            ],
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
        return parent::install() &&
            $this->installSql() &&
            $this->registerHook('additionalCustomerAddressFields') &&
            $this->registerHook('actionAfterCreateAddressFormHandler') &&
            $this->registerHook('actionAfterUpdateAddressFormHandler') &&
            $this->registerHook('actionValidateCustomerAddressForm') &&
            $this->registerHook('actionObjectAddressAddBefore') &&
            $this->registerHook('actionObjectAddressAddAfter') &&
            $this->registerHook('actionObjectAddressUpdateAfter') &&
            $this->registerHook('actionObjectAddressDeleteAfter') &&
            $this->registerHook('actionFrontControllerSetMedia');
    }


    public function uninstall()
    {
        return parent::uninstall() && $this->uninstallSql();
    }

    private function installSql()
    {
        $sql = array();

        $sql[] = '
            CREATE TABLE `' . pSQL(_DB_PREFIX_) . 'city_list` (
            `id_citylist` INT AUTO_INCREMENT NOT NULL,
            `id_country` INT NOT NULL,
            `city_name` VARCHAR(64) NOT NULL,
            `active` TINYINT(1) NOT NULL,
            PRIMARY KEY(id_citylist))
            DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE =' . pSQL(_MYSQL_ENGINE_) . ';
            ';

        $sql[] = '
            CREATE TABLE `' . pSQL(_DB_PREFIX_) . 'city_list_customer_address` (
            `id_citylist_customer_address` INT AUTO_INCREMENT NOT NULL,
            `id_address` INT DEFAULT NULL,
            `id_citylist` INT DEFAULT NULL,
            PRIMARY KEY(id_citylist_customer_address))
            DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE =' . pSQL(_MYSQL_ENGINE_) . ';
            ';

        foreach ($sql as $query) {
            if (DB::getInstance()->execute($query) == false) {
                return false;
            } else {
                return true;
            }
        }
    }


    private function uninstallSql()
    {
        $sql = array();

        $sql[] = 'DROP TABLE IF EXISTS `' . pSQL(_DB_PREFIX_) . 'city_list`';
        $sql[] = 'DROP TABLE IF EXISTS `' . pSQL(_DB_PREFIX_) . 'city_list_customer_address`';

        foreach ($sql as $query) {
            if (Db::getInstance()->execute($query) == false) {
                return false;
            } else {
                return true;
            }
        }
    }





    //Hook Section

    public function HookAdditionalCustomerAddressFields($params)
    {
        //Get city from database
        $cities = \Db::getInstance()->executeS('
            SELECT * FROM `' . pSQL(_DB_PREFIX_) . 'city_list` WHERE `active` = 1
        ');


        $formField = (new FormField)
            ->setName('id_citylist')
            ->setType('select')
            ->setRequired(true)
            ->setLabel($this->getTranslator()->trans('City', [], 'Modules.Citylist.Front'));


        if (Tools::getIsset('id_address')) {
            $address = new Address(Tools::getValue('id_address'));

            if ($address->country != 32) $formField->setRequired(false);


            if (!empty($cities)) {
                foreach ($cities as $city) {
                    $formField->addAvailableValue(
                        $city['id_citylist'],
                        $city['city_name']
                    );
                }
                if (!empty($address->id)) {
                    $id_citylist =  \Db::getInstance()->executeS('SELECT `id_citylist` FROM `' . _DB_PREFIX_ . 'city_list_customer_address` WHERE `id_address` = ' . $address->id);
                    $formField->setValue($id_citylist[0]['id_citylist']);
                }
            }
        }

        return array(
            $formField
        );
    }



    public function HookActionAfterCreateAddressFormHandler($params)
    {
        $this->updateAddress($params);
    }

    public function HookActionAfterUpdateAddressFormHandler($params)
    {
    }

    public function HookActionFrontControllerSetMedia()
    {
        $this->context->controller->registerJavascript(
            'citylist-javascript',
            $this->_path . 'views/js/citylist.js',
            [
                'position' => 'bottom',
                'priority' => 1000,
            ]
        );
    }

    public function HookActionObjectAddressAddAfter($params)
    {

        // dump($params);
        // die();
        if ($params['object']->id_citylist != null) {
            $db = \Db::getInstance();
            $result = $db->insert('city_list_customer_address', [
                'id_address' => (int) $params['object']->id,
                'id_citylist' => (int)$params['object']->id_citylist,
            ]);

            return $result;
        }
    }

    public function HookActionObjectAddressUpdateAfter($params)
    {
        // dump($params);
        // die();
        if ($params['object']->id_citylist != null) {
            $db = \Db::getInstance();
            $result = $db->update('city_list_customer_address', [
                'id_citylist' => (int)$params['object']->id_citylist,
            ], 'id_address =' . (int) $params['object']->id, 1);

            return $result;
        }
    }

    public function HookActionObjectAddressDeleteAfter($params)
    {
        if ($params['object']->id_citylist != null) {
            $db = \Db::getInstance();
            $result = $db->delete('city_list_customer_address', 'id_address =' . (int) $params['object']->id);

            return $result;
        }
    }


    public function HookActionValidateCustomerAddressForm($params)
    {
    }


    // Get address information for update
    private function updateAddress($params)
    {
        $addressId = (int)$params['id'];
        $city = $params['form_data'];

        $this->updateCity($city, $addressId);
    }

    //Update address city
    private function updateCity($city, $addressId)
    {
        // $address =  new Address($addressId);
        // $address->city = $city;
        // $address->update();

        Logger::addLog('message');
        dump($city);
        die();

        // $db = \Db::getInstance();
        // $result = $db->update('city_list_customer_address', [
        //     'id_citylist' => (int)$city,
        // ], 'id_address =' . (int) $addressId);

        // return $result;
    }
}