jQuery(function($){
    // The "$" variable is now scoped in here
    // and will not be affected by any code
    // overriding it outside of this function

	var wwkwqpp = {};

	wwkwapp = {

		el:{

			redirects: $('.redirects'),
			redirect_table: $('.redirect_table')
		},

		events: function(){

			// User click on delete redirect
			this.el.redirects.on('click','.delete_redirect',function(e){

				wwkwapp.delete_redirect($(this));

				e.preventDefault();

			});

			// User click on delete redirect
			this.el.redirects.on('click','.add_redirect',function(e){

				wwkwapp.add_redirect($(this));

				e.preventDefault();

			});

		},

		delete_redirect: function(el){

			el.parents('tr').remove();

		},

		add_redirect: function(){

			var template = $(_.template($('#redirect').html())());

			this.el.redirect_table.append(template);

		}

	};

	// Init user events
	wwkwapp.events();

});