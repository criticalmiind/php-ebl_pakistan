<br/>
<?php
    $announcement = get_setting($con, 'announcement');
    if($announcement){
?>
    <div class="alert alert-warning" role="alert">
        <?php echo $announcement; ?>

        </br></br>
        <strong>خبردار:</strong>اسلام وعلیکم! کچھ  تیکنیکی وجوھات کی وجہ سے ہم سب ممبرز کو اگاہی دے رہے ہیں، کہ اکاونٹ نمبر (03450333262) پر کوئ پیسے جمہ نہ کرے، ورنہ بعد میں ہم ذمہ دار نہ ہوںگے، بہت جلد ہم نیا اکاونٹ نمبر دے دینگے! شکریہ!
        </br></br></br>
        Contact: info@eblpakistan.com
    </div>
<?php } ?>
<br/>