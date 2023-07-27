var url = 'http://localhost/mini-instagram/';

window.addEventListener("load", function(){
    
    $('.btn-like').css('cursor', 'pointer');
    $('.btn-dislike').css('cursor', 'pointer');
    
    
    // Boton de Like
    function like(){
        $('.btn-like').unbind('click').click(function(){
            console.log('like');
            $(this).addClass('btn-dislike').removeClass('btn-like');
            $(this).attr('src',url+'/resources/img/heart-red.png');
            
            $.ajax({
                url: url+'public/like/'+$(this).data('id'),
                type: 'GET',
                success: function(response){
                    if(response.like){
                        console.log('Like ok');
                    }else{
                        console.log('Error al dar like');
                    }
                }
            });
            
            dislike();
        });
    }
    like();
    
    // Boton de DisLike
    function dislike(){
        $('.btn-dislike').unbind('click').click(function(){
            console.log('dislike');
            $(this).addClass('btn-like').removeClass('btn-dislike');
            $(this).attr('src',url+'/resources/img/heart-black.png');
            
            $.ajax({
                url: url+'public/dislike/'+$(this).data('id'),
                type: 'GET',
                success: function(response){
                    if(response.like){
                        console.log('DisLike ok');
                    }else{
                        console.log('Error al dar Dislike');
                    }
                }
            });
            
            like();
        });
    }
    dislike();
});