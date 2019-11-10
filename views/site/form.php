<?php
/**
 * @var \app\models\Url $model Model
 */

$shortUrl = Yii::$app->session->getFlash('shortUrl');
if (!empty($shortUrl)) {
    echo 'Short url: ' . $shortUrl[0] . '<br>';
}

if ($model->hasErrors()) {
    foreach ($model->errors as $error) {
        echo $error[0] . '<br>';
    }
} ?>


<form method="post">
    <label for="long_url">Long url</label>
    <input id="long_url" type="text" name="long_url">
    <button type="submit">Send</button>
</form>
