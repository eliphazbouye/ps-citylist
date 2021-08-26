<div class="panel everheader">
    <div class="panel-body">
        <div class="col-md-12">
            <div class="table-responsive">
                <table>
                    <tr class="center small bold center">
                        <td>{l s='City delivery informations' mod='citylist'}</td>
                    </tr>
                </table>
                <table id="everpsshippingperpostcode"
                    class="display responsive nowrap dataTable no-footer dtr-inline collapsed table">
                    <thead>
                        <tr class="center small grey bold center">
                            <th>{l s='Delivery city' mod='citylist'}</th>
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