var Post = Backbone.Model.extend( {
    urlRoot: "/post/"
} );

// TIP: initialize is like a constructor but will run after the model has loaded
var Partial = Backbone.Model.extend( {
    initialize: function( filename ){
        this.url = "/templates/partials-compiled/"+filename+".json"
    }
} );

var Collage = Backbone.Collection.extend( {

    initialize: function( page ){
      this.url = "/collage/"+page
    },

    parse: function( response ){
        return response.posts;
    }

} );