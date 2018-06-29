( function( api ) {

	// Extends our custom "hat-bazar-frontpage-sections" section.
	api.sectionConstructor['hat-bazar-frontpage-sections'] = api.Section.extend(
		{

				// No events for this type of section.
			attachEvents: function () {},

				// Always make the section active.
			isContextuallyActive: function () {
				return true;
			}
		}
	);

	api.sectionConstructor['hat-bazar-frontpage-instructions'] = api.Section.extend(
		{

				// No events for this type of section.
			attachEvents: function () {},

				// Always make the section active.
			isContextuallyActive: function () {
				return true;
			}
		}
	);

	api.sectionConstructor['hat-bazar-order-upsell'] = api.Section.extend(
		{

				// No events for this type of section.
			attachEvents: function () {},

				// Always make the section active.
			isContextuallyActive: function () {
				return true;
			}
		}
	);

	api.sectionConstructor['hat-bazar-view-pro'] = api.Section.extend(
		{

				// No events for this type of section.
			attachEvents: function () {},

				// Always make the section active.
			isContextuallyActive: function () {
				return true;
			}
		}
	);

} )( wp.customize );
