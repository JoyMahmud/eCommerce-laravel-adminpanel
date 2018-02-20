$(document).ready(function() {

    $('#changePassword').bootstrapValidator({


        message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },

        fields: {
            current_password: {
                validators: {
                    notEmpty: {
                        message: 'The password is required and can\'t be empty'
                    },
                    stringLength: {
                        min: 6,
                        max: 30,
                        message: 'The password must be more than 6 and less than 30 characters long'
                    }

                }
            },
            new_password: {
                validators: {
                    notEmpty: {
                        message: 'The password is required and can\'t be empty'
                    },
                    stringLength: {
                        min: 6,
                        max: 30,
                        message: 'The password must be more than 6 and less than 30 characters long'
                    }

                }
            },
            confirm_password: {
                validators: {
                    notEmpty: {
                        message: 'The password is required and can\'t be empty'
                    },
                    stringLength: {
                        min: 6,
                        max: 30,
                        message: 'The password must be more than 6 and less than 30 characters long'
                    }

                }
            }

        }

    });
    $('#review-form').bootstrapValidator({


        message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },

        fields: {
            quality: {
                validators: {
                    notEmpty: {
                        message: 'The quality is required and can\'t be empty'
                    }
                }
            },
            price: {
                validators: {
                    notEmpty: {
                        message: 'The price is required and can\'t be empty'
                    }
                }
            },
            value: {
                validators: {
                    notEmpty: {
                        message: 'The value is required and can\'t be empty'
                    }
                }
            },
            review: {
                validators: {
                    notEmpty: {
                        message: 'The review text is required and can\'t be empty'
                    }
                }
            }
        }

    });
    $('#loginForm').bootstrapValidator({


        message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },

        fields: {
            email: {
                validators: {
                    notEmpty: {
                        message: 'The email address is required and can\'t be empty'
                    },
                    emailAddress: {
                        message: 'The input is not a valid email address'
                    }
                }
            },
            password: {
                validators: {
                    notEmpty: {
                        message: 'The password is required and can\'t be empty'
                    },
                    stringLength: {
                        min: 6,
                        max: 30,
                        message: 'The password must be more than 6 and less than 30 characters long'
                    }

                }
            }
        }

    });
    $('#newShippingForm').bootstrapValidator({


        message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },

        fields: {
            first_name: {
                message: 'The First Name is not valid',
                validators: {
                    notEmpty: {
                        message: 'The First Name is required and can\'t be empty'
                    },
                    stringLength: {
                        min: 2,
                        max: 30,
                        message: 'The First Name must be more than 2 and less than 30 characters long'
                    },
                    regexp: {
                        regexp: /^[A-z]+$/,
                        message: 'The First Name can only consist of alphabetical'
                    }
                }
            },
            last_name: {
                message: 'The Last Name is not valid',
                validators: {
                    notEmpty: {
                        message: 'The Last Name is required and can\'t be empty'
                    },
                    stringLength: {
                        min: 2,
                        max: 30,
                        message: 'The Last Name must be more than 2 and less than 30 characters long'
                    },
                    regexp: {
                        regexp: /^[A-z]+$/,
                        message: 'The Last Name can only consist of alphabetical'
                    }
                }
            },
            country: {
                validators: {
                    notEmpty: {
                        message: 'The country is required and can\'t be empty'
                    }
                }
            },
            adress: {
                message: 'The Address is not valid',
                validators: {
                    notEmpty: {
                        message: 'The Address is required and can\'t be empty'
                    }
                }
            },
            mobile: {
                message: 'The Mobile is not valid',
                validators: {
                    notEmpty: {
                        message: 'The Mobile is required and can\'t be empty'
                    },
                    regexp: {
                        regexp: /^(?:\+?88)?01[15-9]\d{8}$/,
                        message: 'The mobile number format is not valid'
                    }
                }
            },
            city: {
                message: 'The City is not valid',
                validators: {
                    notEmpty: {
                        message: 'The City is required and can\'t be empty'
                    }
                }
            },
            state: {
                message: 'The State is not valid',
                validators: {
                    notEmpty: {
                        message: 'The State is required and can\'t be empty'
                    }
                }
            },
            zip: {
                message: 'The Zip is not valid',
                validators: {
                    notEmpty: {
                        message: 'The Zip is required and can\'t be empty'
                    }
                }
            }
        }

    });
    $('#newBillingForm').bootstrapValidator({


        message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },

        fields: {
            email: {
                validators: {
                    notEmpty: {
                        message: 'The email address is required and can\'t be empty'
                    },
                    emailAddress: {
                        message: 'The input is not a valid email address'
                    }
                }
            },
            first_name: {
                message: 'The First Name is not valid',
                validators: {
                    notEmpty: {
                        message: 'The First Name is required and can\'t be empty'
                    },
                    stringLength: {
                        min: 2,
                        max: 30,
                        message: 'The First Name must be more than 2 and less than 30 characters long'
                    },
                    regexp: {
                        regexp: /^[A-z]+$/,
                        message: 'The First Name can only consist of alphabetical'
                    }
                }
            },
            last_name: {
                message: 'The Last Name is not valid',
                validators: {
                    notEmpty: {
                        message: 'The Last Name is required and can\'t be empty'
                    },
                    stringLength: {
                        min: 2,
                        max: 30,
                        message: 'The Last Name must be more than 2 and less than 30 characters long'
                    },
                    regexp: {
                        regexp: /^[A-z]+$/,
                        message: 'The Last Name can only consist of alphabetical'
                    }
                }
            },
            country: {
                validators: {
                    notEmpty: {
                        message: 'The country is required and can\'t be empty'
                    }
                }
            },
            adress: {
                message: 'The Address is not valid',
                validators: {
                    notEmpty: {
                        message: 'The Address is required and can\'t be empty'
                    }
                }
            },
            mobile: {
                message: 'The Mobile is not valid',
                validators: {
                    notEmpty: {
                        message: 'The Mobile is required and can\'t be empty'
                    },
                    regexp: {
                        regexp: /^(?:\+?88)?01[15-9]\d{8}$/,
                        message: 'The mobile number format is not valid'
                    }
                }
            },
            city: {
                message: 'The City is not valid',
                validators: {
                    notEmpty: {
                        message: 'The City is required and can\'t be empty'
                    }
                }
            },
            state: {
                message: 'The State is not valid',
                validators: {
                    notEmpty: {
                        message: 'The State is required and can\'t be empty'
                    }
                }
            },
            zip: {
                message: 'The Zip is not valid',
                validators: {
                    notEmpty: {
                        message: 'The Zip is required and can\'t be empty'
                    }
                }
            }
        }

    });

    $('#registerForm').bootstrapValidator({
        message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            first_name: {
                message: 'The First Name is not valid',
                validators: {
                    notEmpty: {
                        message: 'The First Name is required and can\'t be empty'
                    },
                    stringLength: {
                        min: 2,
                        max: 30,
                        message: 'The First Name must be more than 2 and less than 30 characters long'
                    },
                    regexp: {
                        regexp: /^[A-z]+$/,
                        message: 'The First Name can only consist of alphabetical'
                    }
                }
            },
            last_name: {
                message: 'The Last Name is not valid',
                validators: {
                    notEmpty: {
                        message: 'The Last Name is required and can\'t be empty'
                    },
                    stringLength: {
                        min: 2,
                        max: 30,
                        message: 'The Last Name must be more than 2 and less than 30 characters long'
                    },
                    regexp: {
                        regexp: /^[A-z]+$/,
                        message: 'The Last Name can only consist of alphabetical'
                    }
                }
            },
            gender: {
                validators: {
                    notEmpty: {
                        message: 'The gender is required and can\'t be empty'
                    }
                }
            },
            country: {
                validators: {
                    notEmpty: {
                        message: 'The country is required and can\'t be empty'
                    }
                }
            },
            email: {
                validators: {
                    notEmpty: {
                        message: 'The email address is required and can\'t be empty'
                    },
                    emailAddress: {
                        message: 'The input is not a valid email address'
                    }
                }
            },
            password: {
                validators: {
                    notEmpty: {
                        message: 'The password is required and can\'t be empty'
                    },
                    stringLength: {
                        min: 6,
                        max: 30,
                        message: 'The password must be more than 6 and less than 30 characters long'
                    },
                    identical: {
                        field: 'confirmPassword',
                        message: 'The password and its confirm are not the same'
                    }

                }
            },
            confirmPassword: {
                validators: {
                    notEmpty: {
                        message: 'The confirm password is required and can\'t be empty'
                    },
                    identical: {
                        field: 'password',
                        message: 'The password and its confirm are not the same'
                    }
                }
            }
        }
    });
});