jQuery( document ).ready( function(){

  jQuery("form").submit( function( e ){

    e.preventDefault();
    jQuery.ajax({
      url : '/post/7',
      type : 'PUT',
      success : function(){
        console.log( 'yay !' );
      },
      405 : function(){
        console.log( 'Method not allowed' );
      }
    });


  } );



} );
