(function($) {

  window.addEventListener(
    'load',
    function() {

      // Sirat theme admin notice START
      $.post(
        ive_notice_params.IBTANA_LICENSE_API_ENDPOINT + 'get_client_meta_box_info',
        {
          "theme_text_domain":  ive_notice_params.theme_text_domain
        },
        function ( data ) {

          if ( !data.data.is_found ) {
            $( '#ive-admin-notice-sirat' ).show();
          } else {
            $( '#ive-admin-notice-sirat' ).hide();
          }
        }
      );
      // Sirat theme admin notice END

      // Go back from sirat theme installation START
      if ( location.href.indexOf("ive-sirat-installed=true") >= 0 ) {

        // Select the node that will be observed for mutations
        const targetNode = document.querySelector('.wrap');

        // Options for the observer (which mutations to observe)
        const config = { attributes: true, childList: true, subtree: true };

        // Callback function to execute when mutations are observed
        const callback = function( mutationsList, observer ) {
          // Use traditional 'for loops' for IE 11
          for( const mutation of mutationsList ) {
            if ( mutation.type === 'childList' ) {
            }
            else if (mutation.type === 'attributes') {
            }

            if ( jQuery( '.wrap a[href*="themes.php"]' ).length ) {
              // window.history.back();
              location.href = ive_notice_params.admin_url + 'plugins.php';
            }
          }
        };

        // Create an observer instance linked to the callback function
        const observer = new MutationObserver(callback);

        // Start observing the target node for configured mutations
        observer.observe(targetNode, config);

        // Later, you can stop observing
        // observer.disconnect();

      }
      // Go back from sirat theme installation END



      var data_to_post = {
        action:             'ive_get_admin_notices'
      };
      jQuery.ajax({
        method: "POST",
        url:    ive_notice_params.ajax_url,
        data:   data_to_post
      }).done(function( data ) {

        var ive_admin_notices_res = data.data;

        var show_ive_admin_notices = false;

        for ( var i = 0; i < ive_admin_notices_res.length; i++ ) {
          var ive_admin_notice_data = ive_admin_notices_res[i];

          var ive_show_notice = ive_admin_notice_data.is_ibtana_admin_notice_enabled;

          if ( ive_show_notice ) {

            var ive_admin_notice_id = ive_admin_notice_data.ibtana_admin_notice_unique_id;

            var ive_notice_params_ive_admin_notices = ive_notice_params.ive_admin_notices;

            for ( var j = 0; j < ive_notice_params_ive_admin_notices.length; j++ ) {
              var ive_admin_notice_single = ive_notice_params_ive_admin_notices[j];
              if ( ive_admin_notice_single == ive_admin_notice_id ) {
                ive_show_notice = false;
                break;
              }
            }

            if ( ive_show_notice ) {
              show_ive_admin_notices = true;

              if ( ive_admin_notice_data.ibtana_admin_notice_contents != '' ) {

                if ( ive_admin_notice_data.ibtana_admin_notice_css != '' ) {
                  $( 'head' ).append(
                    `<style>`
                      + ive_admin_notice_data.ibtana_admin_notice_css +
                    `</style>`
                  );
                }

                $( '#ive-admin-notice' ).append(
                  `<div class="notice" data-ive-admin-notice-id="` + ive_admin_notice_id + `">
                    <button type="button" class="ive-admin-notice-dismiss"></button>`
                    + ive_admin_notice_data.ibtana_admin_notice_contents +
                  `</div>`
                );

              }
            }

          }
        }

        if ( show_ive_admin_notices ) {

          $( '.notice[data-ive-admin-notice-id]' ).on( 'click', '.ive-admin-notice-dismiss', function() {

            var ive_admin_notice_el = jQuery( this ).closest( '[data-ive-admin-notice-id]' );

            var ive_admin_notice_id = ive_admin_notice_el.attr( 'data-ive-admin-notice-id' );

            jQuery.post(
              ive_notice_params.ajax_url,
              {
                'action':             'ive_admin_notice_ignore',
                'ive_admin_notice_id': ive_admin_notice_id
              },
              function( result ) {
                ive_admin_notice_el.remove();
                if ( !jQuery('.notice[data-ive-admin-notice-id]').length ) {
                  $( '#ive-admin-notice' ).hide();
                }
              }
            );

          } );

          $( '#ive-admin-notice' ).show();

        }

      });


    },
    false
  );





})( jQuery );
