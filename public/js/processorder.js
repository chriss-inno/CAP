function fnFormatDetails ( oTable, nTr )
{

    var aData = oTable.fnGetData( nTr );
    oTable.fnOpen( nTr, "<i class='icon-spinner'></i> ....", 'details' );
    $.get("summary/"+aData[1],function(data){

        var sOut = '<table style="width: 100%" cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">';
        sOut += data;
        sOut += '</table>';
        oTable.fnOpen( nTr, sOut, 'details' );
    })
}

$(document).ready(function() {

    $('#dynamic-table').dataTable( {
        "aaSorting": [[ 0, "desc" ]]
    } );

    /*
     * Insert a 'details' column to the table
     */
    var nCloneTh = document.createElement( 'th' );
    var nCloneTd = document.createElement( 'td' );
    nCloneTh.className = "center expand";
    nCloneTd.innerHTML = '<img src="images/open.png" title="click here to view more details">';
    nCloneTd.className = "center expand";

    $('#hidden-table-info thead tr').each( function () {
        this.insertBefore( nCloneTh, this.childNodes[0] );
    } );

    $('#hidden-table-info tbody tr').each( function () {
        this.insertBefore(  nCloneTd.cloneNode( true ), this.childNodes[0] );
    } );

    /*
     * Initialse DataTables, with no sorting on the 'details' column
     */
    var oTable = $('#hidden-table-info').dataTable( {
        "aoColumnDefs": [
            { "bSortable": false, "aTargets": [ 0 ] }
        ],
        "aaSorting": [[1, 'asc']]
    });

    /* Add event listener for opening and closing details
     * Note that the indicator for showing which row is open is not controlled by DataTables,
     * rather it is done here
     */
    $(document).on('click','#hidden-table-info tbody td img',function () {
        var nTr = $(this).parents('tr')[0];
        if ( oTable.fnIsOpen(nTr) )
        {
            /* This row is already open - close it */
            this.src = "images/open.png";
            oTable.fnClose( nTr );
        }
        else
        {
            /* Open this row */
            this.src = "images/less.jpg";
            fnFormatDetails(oTable, nTr);
        }
    } );
} );