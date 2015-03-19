{*
<?php
	/**
     * @author  Dennis A. Simpson
     * @copyright  2013
     * @version 1.0
     * @abstract  Intended to clean up frame_admin.tpl.  Only called when conditions are correct
     */
?>
*}

    {if $image == "ecm_1"} 
        <script type="text/javascript">
    		$(document).ready(function() {
    			var zoomer = new FWDZoomer("lightBox", "zoom/load/config1.xml");
    		});
    	</script>   
    {/if}

    {if $image == "ecm_2"} 
        <script type="text/javascript">
    		$(document).ready(function() {
    			var zoomer = new FWDZoomer("imageDiv", "zoom/load/config2.xml");
    		});      
    	</script>
    {/if}

    {if $image == "ecm_3"} 
        <script type="text/javascript">
    		$(document).ready(function() {
    			var zoomer = new FWDZoomer("lightBox", "zoom/load/config3.xml");
    		});
    	</script>
    {/if}
