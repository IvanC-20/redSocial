var url = 'http://proyecto-laravel.com.devel';

window.addEventListener("load", function(){
    //$('body').css('background', 'skyblue');

    $('.btn-like').css('cursor', 'pointer');
    $('.btn-dislike').css('cursor', 'pointer');

    //Botón de like
    function like(){
        $('.btn-like').unbind('click').click(function(){
                
                console.log('like');
                $(this).addClass('btn-dislike').removeClass('btn-like');
                $(this).attr('src', url + '/img/hearts-64-red.png');

                var element = $(this).parent();
                $.ajax({
                    url: url+'/like/'+$(this).data('id'),
                    type: 'GET',
                    success: function(response){
                        if(response.like){
                            $(element).find('.number-likes').text(response.count);
                            console.log('Has dado like a la publicación');
                       
                        }else{
                            console.log('Error al dar like');
                        } 
                      
                    }
                });

                dislike();
        });
        
    }
    like();

    //Botón dislike
    function dislike(){
        $('.btn-dislike').unbind('click').click(function(){
            
            console.log('dislike');
            $(this).addClass('btn-like').removeClass('btn-dislike');
            $(this).attr('src', url + '/img/hearts-64.png');

            var element = $(this).parent();
            $.ajax({
                url: url+'/dislike/'+$(this).data('id'),
                type: 'GET',
                success: function(response){
                    
                    if(response.like){
                        $(element).find('.number-likes').text(response.count);
                        console.log('Has dado dislike a la publicación');
                       
                    }else{
                        console.log('Error al dar dislike');
                    }    
                }
            });

            like();
        });

    }
    dislike();

    //buscador
    $('#buscador').submit(function(){
        $(this).attr('action', url + '/personas/' + $('#buscador #search').val());
        
    });
    
});