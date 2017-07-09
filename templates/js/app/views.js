var PageView = Backbone.View.extend( {

    render: function(){

        // Create vars so we can pass them into callback function
        var collection = this.collection;
        var element = this.$el;
        var partials = [];

        // Load partials and append filename to defined root url
        var header = new Partial( "header" );
        partials.push( header );

        _.each( collection, function( post ){
            partials.push( new Partial( "post" ) );
        } );

        var footer = new Partial( "footer" );
        partials.push( footer );

        // When all partials are done fetching call callback function
        var complete = _.invoke( partials, "fetch" );
        $.when.apply($, complete).done( function(){

            // Header is always first partial, likewise footer should always be last partial
            var template = _.template( partials[0].get("template") );
            element.append( template );

            _.each( collection, function( post, index ){
                partial = partials[index+1].toJSON();
                template = _.template( partial.template );
                template = template( {post: collection.models[index]} );
                $("main").append( template );
            } );

        } );

    }

} );