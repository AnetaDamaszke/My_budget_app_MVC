/**
 * Add jQuery Validation plugin method for a valid password
 * 
 * Valid passwordds contain at least one letter and one nunmber
 */


$.validator.addMethod('validPassword',
            function(value, element, param) {
                if (value != '') {
                    if(value.match(/.*[a-z]+.*/i) == null) {
                        return false;
                    }
                }
                if (value != '') {
                    if(value.match(/.*\d+.*/) == null) {
                        return false;
                    }
                }

                return true;
            },
            'Must contain at least one letter and one number'
        );