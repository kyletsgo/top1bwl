/**
 *
 * @authors Eric Hsiao
 *
 */

simplePage = function (){

	//private menbers

	//private methods
	function init () {
    console.log('simplePage is loaded.');

    
  }
  
  function intoPage() {
    
  }

  function leavePage() {
    
  }

	//constructor
	{
		$(document).ready(function() {
			init();
		});
	}

	//public

	return {
    intoPage : function () {
      intoPage();
    },
    leavePage : function () {
      leavePage();
    }
	};
};

var simplePage = new simplePage();