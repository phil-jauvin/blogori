var AdminView = Backbone.View.extend( {

    initialize: function(){
        $('html, body').animate({ scrollTop: 0 }, 'fast'); // Can't decide whether I like the animation or not
        this.render();
    },

    render: function(){

        // Create vars so we can pass them into callback function
        var partials = [];

        var admin = new Partial( "admin" );
        partials.push( admin );

        // When all partials are done fetching call callback function
        var complete = _.invoke( partials, "fetch" );
        $.when.apply($, complete).done( function(){

            template = _.template( admin.get("template") );
            $("body").append( template );

        } );

    }

} );