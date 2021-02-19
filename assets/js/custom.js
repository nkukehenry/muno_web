/* ------------------------------------------------------------------------------
 *
 *  # Custom JS code
 *
 * 
 *
 * ---------------------------------------------------------------------------- */

  var showLoader = function(msg) {
              $.blockUI({ 
                  message: '<i class="icon-spinner4 spinner"></i><br>'+msg,
                  //timeout: 5000, //unblock after 2 seconds
                  overlayCSS: {
                      backgroundColor: '#1b2024',
                      opacity: 0.8,
                      cursor: 'wait'
                  },
                  css: {
                      border: 0,
                      color: '#fff',
                      padding: 0,
                      backgroundColor: 'transparent'
                  }
              });
            }

 var hideLoader = function(){

 	$.unblockUI();
 }

  var loaderUp = function(msg) {
              $.blockUI({ 
                  message: '<i class="icon-spinner10 icon3x spinner"></i><br>Please wait...',
                  timeout: 2000, //unblock after 2 seconds
                  overlayCSS: {
                      backgroundColor: '#05204a',
                      opacity: 0.8,
                      cursor: 'progress'
                  },
                  css: {
                      border: 0,
                      color: '#fff',
                      padding: 0,
                      backgroundColor: 'transparent'
                  }
              });
            }

            loaderUp();