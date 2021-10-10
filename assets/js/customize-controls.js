( function( api ) {

	// Extends our custom "knowledge-base-lite" section.
	api.sectionConstructor['knowledge-base-lite'] = api.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

} )( wp.customize );