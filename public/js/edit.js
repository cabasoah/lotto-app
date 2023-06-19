$(function(){
    $(document).delegate('#results_tb tr td','click',function(){
        // console.log();
        $('#edit_results .results1').val($(this).data('result1'));
        $('#edit_results .results2').val($(this).data('result2'));
        $('#edit_results .results3').val($(this).data('result3'));
        $('#edit_results .results4').val($(this).data('result4'));
        $('#edit_results .results5').val($(this).data('result5'));
        $('#edit_results .results_id').val($(this).data('id'));
        $('#edit_results .game_id').val($(this).data('gameid'));

        //show modal
        $('#edit_results').modal('show');           
    })
}) 