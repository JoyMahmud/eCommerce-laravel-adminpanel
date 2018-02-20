/**
 * Created by infelicitas on 5/23/16.
 */


    $(document).ready(function(){







        $('#region_id').change(function(){

            if($(this).val() == " ")
            {
                $('#city_id').empty();
                alert('please select region');

            }
            else
            {
                $.ajax({
                    type : 'POST',
                    url : $('#_route_city_list').val(),
                    data  : {'choice':$(this).val(),'_token':$('#_token').val()},
                    dataType : 'json',
                    error : function(response){
                        alert('SOMETHING WENT WRONG,TRY AGAIN');
                    },
                    success : function(response){
                        $('#city_id').html(response);
                    }
                });

            }



        })

        $('#city_id').change(function(){
            if($(this).val() == " ")
            {
                $('#area_id').empty();
                alert('please select region');

            }
            else
            {
                $.ajax({
                    type : 'POST',
                    url : $('#_route_area_list').val(),
                    data  : {'choice':$(this).val(),'_token':$('#_token').val()},
                    dataType : 'json',
                    error : function(response){
                        alert('SOMETHING WENT WRONG,TRY AGAIN');
                    },
                    success : function(response){
                        $('#charge_area_id').html(response);
                        $('#pre_order_area_id').html(response);
                    }
                });
            }
        })


        $('#charge_area_id').change(function(){
            if($(this).val() == " ")
            {
                alert('please select area');

            }
            else
            {
                $.ajax({
                    type : 'POST',
                    url : 'generate-charge',
                    data  : {'choice':$(this).val(),'_token':$('#_token').val()},
                    dataType : 'json',
                    error : function(response){
                        alert('SOMETHING WENT WRONG,TRY AGAIN');
                    },
                    success : function(response){
                        $('#shipping_value').text(response.charge);
                        $('#payable').text(response.payable);
                    }
                });
            }
        })


        $('#pre_order_area_id').change(function(){
            if($(this).val() == " ")
            {
                alert('please select area');

            }
            else
            {
                $.ajax({
                    type : 'POST',
                    url : 'generate-charge',
                    data  : {'choice':$(this).val(),'preorder_amount':$('#_preorder_amount').val(),'_token':$('#_token').val()},
                    dataType : 'json',
                    error : function(response){
                        alert('SOMETHING WENT WRONG,TRY AGAIN');
                    },
                    success : function(response){
                        $('#shipping_value').text(response.charge);
                        $('#payable').text(response.payable);
                    }
                });
            }
        })


    });

