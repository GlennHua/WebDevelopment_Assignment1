<html>
<body bgcolor="#DCDCDC">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <title>Post Status Page</title>
    <style type="text/css">
        span {
            padding-right: 20px;
            width: 150px;
            display: block;
            float: left;
            line-height: 25px;
        }

        .uni {
            background: #44a07a;
            color: white;
            padding: 30px;
            margin: 10px 300px;
            border-radius: 15px;
        }

        .button {
            width: 120px;
            height: 30px;
            border-radius: 10px;
            background: #44a07a;
            font-size: 20px;
            color: #fff;
        }
    </style>
</head>

<body>

<form action="poststatusprocess.php" method="POST">
    <div class="uni">
        <h1>Post a new status</h1>
    </div>
    </br>

    <div class="uni">
        <span><b>Status Code<font size="2">(Required):</font></b></span>
        &nbsp
        &nbsp
        <input type="text" name="statuscode" id="statuscode" placeholder="Please enter your status code here"
               pattern="S\d{4}" title="Status Code requires Start with Uppercase'S' and followed by 4 numbers"
               required="required" maxLength=5 style="text-align:center;width:400px;"/>
    </div>


    <div class="uni">
        <span><b>Status<font size="2">(Required):</font></b></span>
        &nbsp
        &nbsp
        <input type="text" name="status" id="status" placeholder="Please enter your status here" required="required"
               style="text-align:center;width:400px;"/>
    </div>

    <div class="uni">
        <span><b>Share</b></span>
        &nbsp
        &nbsp
        <label><input type="radio" name="share" value="Public"> <b>Public</b> </label>
        <label><input type="radio" name="share" value="Friends"> <b>Friends</b> </label>
        <label><input type="radio" name="share" value="Only me" checked="checked"> <b>Only me</b> </label>
    </div>

    <div class="uni">
        <span><b>Date</b></span>
        &nbsp
        &nbsp
        <input type="date" name="date" id="date" required="required"/>
    </div>
    <div class="uni">
        <span><b>Permission Type</b></span>
        &nbsp
        &nbsp
        <input type="checkbox" name="type[]" value="Allow Like"/><b>Allow Like</b>
        <input type="checkbox" name="type[]" value="Allow Comment"/><b>Allow Comment</b>
        <input type="checkbox" name="type[]" value="Allow Share"/><b>Allow Share</b>
    </div>

    <div class="uni">
        <button type="submit" class="button">POST</button>
        <button type="reset" class="button">Reset</button>
        <a class="button" style="margin-left:500px;margin-top:600px" href="index.html">Return to Home Page</a>
    </div>
</form>
</body>
</html>
