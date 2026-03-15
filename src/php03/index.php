<?php
// status_codes.phpを一度だけ読み込み。
require_once('config/status_codes.php');

// $random_indexesは元データのstatus_codes.phpから4つ選んでrandom_indexesに格納したもの（順番は区別無し）
$random_indexes = array_rand($status_codes, 4);

// foreach (...)は $random_indexes を、一つずつ取り出して $index という変数に代入、を繰りかえす。
foreach ($random_indexes as $index) {
  // 取り出したデータを、新しい配列 $options の末尾に追加（格納）
  $options[] = $status_codes[$index];
}// optionsはforeach ループで作成された4つのステータスコードが入った配列（順番あり）

$question = $options[mt_rand(0, 3)];
// $questionは$options の中からランダムに選ばれた、正解となる1つの値


// $random_indexes 元データから4つ選んで格納した箱（順番は区別無し）
// $options　4つのコードがはいった順番ありの配列
// $option　配列から取り出したいつのコード
// $question　$options の中から選ばれた正解の値

?>

<!DOCTYPE html> 
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Status Code Quiz</title>
  <link rel="stylesheet" href="css/sanitize.css">
  <link rel="stylesheet" href="css/common.css">
  <link rel="stylesheet" href="css/index.css">
</head>

<body>
  <header class="header">
    <div class="header__inner">
      <a class="header__logo" href="/">
        Status Code Quiz
      </a>
    </div>
  </header>

  <main>
    <div class="quiz__content">
      <div class="question">
        <p class="question__text">Q. 以下の内容に当てはまるステータスコードを選んでください</p>
        <p class="question__text">
<?php // 直前の処理でランダムに選ばれた $question　の中から、そのコードの意味や説明文）けを取り出して、画面に表示 ?>
<?php // 'description'はステータスコードの意味や説明文 ?>
          <?php echo $question['description'] ?>
        </p>

      </div>
      <form class="quiz-form" action="result.php" method="post">
<?php //回答ボタンを押したとき、データを result.php というファイルに送りなさい ?>
        <input type="hidden" name="answer_code" value="<?php echo $question['code'] ?>">
<?php //answer_code は隠された正解。
// optionは表側でユーザーが選んだもの
// $question という箱の中には「説明文」や「コード番号」など複数のデータが入っています。その中から 「コード番号（例：200）」だけを指定して取り出す という意味です。 ?>
        <div class="quiz-form__item">
          <?php foreach ($options as $option) : ?>
<?php //前の工程で作った4つの選択肢（$options）を、1つずつ（$option）取り出す、を繰り返す ?> 
        <div class="quiz-form__group">
              <input class="quiz-form__radio"
              id="<?php echo $option['code'] ?>" 
<?php //ボタン固有の背番号(200 や 404) ?>
              type="radio"
<?php //複数の選択肢の中から1つだけ選べるラジオボタン ?>
               name="option"
                value="<?php echo $option['code'] ?>">
<?php // ユーザーがこのボタンを選んで送信したときに実際に送られる「値」(404 など)です。?>
              <label class="quiz-form__label" for="<?php echo $option['code'] ?>">
<?php // id="200" と <label for="200"> をセットにすると、ブラウザが「この丸ボタンと、横にある『200』という文字は**セット（一心同体）**ですよ」と認識します。?>
                <?php echo $option['code'] ?>
              </label>
            </div>
          <?php endforeach; ?>
<?php // 役割: foreach（繰り返し処理）の出口です。意味: 「4つの選択肢を1つずつ作る作業はここで終わりです」とコンピュータに伝えています。これより下に書いたコードは、4回繰り返されることはなく、1回だけ表示されます。?>
<?php //ループ4回分の実況中継1回目（$index = 0）：$status_codes の1番目の情報（例：200, OK）を取り出す。name="option"、value="200"、id="200" のボタンとラベルを1つ作る。2回目（$index = 1）：2番目の情報（例：404, Not Found）を取り出す。name="option"、value="404"、id="404" のボタンとラベルをもう1つ作る。3回目（$index = 2）：3番目の情報を取り出し、同じようにボタンを追加で作る。3回目（$index = 3）：4番目の情報を取り出し、最後のボタンを作って完了?>
        </div>
        <div class="quiz-form__button">
          <button class="quiz-form__button-submit" type="submit">
            回答
          </button>
<?php // type="submit" とは何か？一言で言うと、**「このボタンは、フォーム（書類一式）を送信するための実行スイッチですよ！」**という宣言です。?>
        </div>
      </form>
    </div>
  </main>
</body>

</html>

<?php //answer_code	200（例）	正解（hidden で隠していtaoption	404（例）	ユーザーが選んだ回答（ラジオボタン?>