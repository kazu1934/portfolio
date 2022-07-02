<?php
// DBからデータを取得する
require_once 'MYDB.php';
$pdo = db_connect();
try {
    // 『名前|本文|日付|曜日(数値)|時間』 の形式で、時間で逆ソートして取得
    $sql = "select name, msg, date_format(date,'%Y/%m/%d') as date, date_format(date, '%w') as weekday, time(date) as time from test_bbs order by timestamp(date) desc";
    $stmh = $pdo->query($sql);
} catch (PDOException $Exception) {
    die("エラー：" . $Exception->getMessage());
}
// 出力用の配列にとっておく
$all = $stmh->fetchAll(PDO::FETCH_ASSOC);
// 曜日日本語変換用
$weekdays = array('日', '月', '火', '水', '木', '金', '土');
// 切断
$pdo = null;
?>

<html>
    <head>
        <title>掲示板データ表示</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <table border="1">
            <caption>掲示板</caption>
            <thead><tr><th>お名前</th><th>メッセージ</th><th>日時</th></tr></thead>
            <?php
            // テーブルデータを1行ずつ表示
            foreach ($all as $row) {
                // YYYY/MM/DD 曜日 HH:mm:ss　の形式に連結する
                $date = "${row['date']} ${weekdays[$row['weekday']]} ${row['time']}";
                ?>
                <tr>
                    <td><?= htmlspecialchars($row['name']) ?>さん</td>
                    <td><?= nl2br(htmlspecialchars($row['msg']), false) ?></td>
                    <td><?= $date ?></td>
                </tr>
                <?php
            }
            ?>
        </table>

    </body>
</html>