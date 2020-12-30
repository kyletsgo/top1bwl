<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reset Redeem (For Test Only)</title>
</head>
<body>

<button onclick="reset()">Reset Redeem</button>

<script>
    function reset()
    {
        let r = confirm("是否要重置測試站所有 Redeem 資料");
        if (r === true) {
            location.href = '/api/resetRedeem';
        }
    }
</script>

</body>
</html>