var PageView = Backbone.View.extend( {

    initialize: function(){
        $('html, body').animate({ scrollTop: 0 }, 'fast'); // Can't decide whether I like the animation or not
        this.firstload = Backbone.history.firstLoad;
        this.render();
    },

    render: function(){

        // Create vars so we can pass them into callback function
        var that = this;
        var partials = [];
        var inc = 0;

        if( that.firstload ){
            var header = new Partial( "header" );
            partials.push( header );
            inc = 1;
        }

        _.each( that.collection, function( post ){
            partials.push( new Partial( "post" ) );
        } );

        // When all partials are done fetching call callback function
        var complete = _.invoke( partials, "fetch" );
        $.when.apply($, complete).done( function(){

            if( that.firstload ){
                var template = _.template( header.get("template") );
                $("body").append( template );
            }
            else{
                $("main").empty();
            }

            _.each( that.collection, function( post, index ){
                var partial = partials[index+inc].toJSON();
                template = _.template( partial.template );
                template = template( {post: that.collection.models[index]} );
                $("main").append( template );
            } );

        } );

    }

} );