{**
 * 2007-2018 PrestaShop
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Academic Free License 3.0 (AFL-3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/AFL-3.0
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future. If you wish to customize PrestaShop for your
 * needs please refer to http://www.prestashop.com for more information.
 *
 * @author    PrestaShop SA <contact@prestashop.com>
 * @copyright 2007-2018 PrestaShop SA
 * @license   https://opensource.org/licenses/AFL-3.0 Academic Free License 3.0 (AFL-3.0)
 * International Registered Trademark & Property of PrestaShop SA
 *}

<div class="card col-lg-12 p-3">
    <h3 class="bootstrap cardheader everpsshippingperpostcode">
        {l s='City delivery information' mod='adminordercustom'}
    </h3>
    <div class="bootstrap cardbody everpsshippingperpostcode">
        <div class="panel-heading">
            <div class="panel everheader">
                <div class="panel-body">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table id="everpsshippingperpostcode"
                                class="display responsive nowrap dataTable no-footer dtr-inline collapsed table">
                                <thead>
                                    <tr class="center small grey bold center">
                                        <th>{l s='City delivery information' mod='citylist'}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="option_value center small">
                                            {$city_name|escape:'htmlall':'UTF-8'}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <a href="#" class="btn btn-success">{l s='Direct link to module configuration' mod='citylist'}</a>
        </div>
    </div>
</div>