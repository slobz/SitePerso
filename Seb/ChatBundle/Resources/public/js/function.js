/**
 * JS pour le chat
 * @author Sébastien 26/02/14
 * @version 1.0
 * @changelog
 * Rev 1.0 26/02/14
 * - Version initiale
 * 
 * @todo Gérer le postionnement en bas si hauteurMessage > tailleContenu 
 *        (fonction)
 * 
 */

$(function() {

    var CONTENU_HEIGHT = 99999;  // Temporaire

    var sender = 1;
    var receiver = 1;
    var name = 'Seb';

    // On load les messages toutes les une secondes
    setInterval(function() {

        // On charge les dernier message depuis le dernier load
        $.post('chat', {'params[]': [sender, 'load']},
        function(data) {
            //console.log("Data du load:");
            //console.log(data['id_message']);

            $.each(data['id_message'], function(i, val) {
                $('#contenu').append('<div> [@todo] '+ name + ' : ' + val + '</div>');
            });

            $('#contenu').scrollTop(CONTENU_HEIGHT);
        });

        //console.log('Sender : ' + sender);
        //console.log('Receiver : ' + receiver);

    }, 5000);

    // Envoi du message
    $('#form-send').submit(function(event) {

        var id_message = 0;

        // Ajout du message        
        // Appel AJAX pour ajout dans la BD
        $.post('chat', {'params[]': [$('#input').val(), 'add',sender,receiver]},
        function(data) {
            // console.log(data);
            $('#input').val('');
        });

        return false;
    });

    // Seb choisi comme compte
    $('#account-seb').click(function(event) {
        sender = 1;
        receiver = 2;
        name = 'Seb';
    });

    // Jud choisi comme compte
    $('#account-jud').click(function(event) {
        sender = 2;
        receiver = 1;
        name = 'Jud la pute';
    });


    // Ajout des meme
    $('.meme').click(function(event){
       $('#input').val($(this).find('img').attr('src'));
    });

});