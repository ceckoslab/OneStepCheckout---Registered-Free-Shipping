Event.observe(window, 'load', function() {
    var registerCheckbox = $('id_create_account');

    if(registerCheckbox != undefined) {
        Event.observe('id_create_account', 'click', function(event) {
            var shippingMethodsBlock = $$('.onestepcheckout-shipping-method-block .shipment-methods')[0];

            var element = Event.element(event);

            var param = '';
            if(element.checked) {
                param = 'register/1';
            } else {
                param = 'register/0';
            }

            var url = '/oscregisteredfreeshipping/ajax/update/' + param;

            shippingMethodsBlock.update('<div class="loading-ajax">&nbsp;</div>');

            new Ajax.Request(url, {
                method: 'get',
                onSuccess: function(transport)    {
                    if(transport.status == 200)    {
                        var data = transport.responseText.evalJSON();

                        shippingMethodsBlock.update(data.shipping);

                        $$('dl.shipment-methods input').invoke('observe', 'click', get_separate_save_methods_function('/onestepcheckout/ajax/set_methods_separate', true));

                    }
                }
            });

        });
    }
});