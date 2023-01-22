<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Title of the document</title>
</head>

<body>
    <table>
        <tr><td>Dear {{ $name }} </td></tr>
        <tr><td>&nbsp;<br></td></tr>
        <tr><td>Please click on link below to activate your account :-</td></tr>
        <tr><td>&nbsp;<br></td></tr>
        <tr><td><a href="{{ url('/user/confirm/'.$code) }}">Confirm Account</a></td></tr>
        <tr><td>&nbsp;<br></td></tr>
        <tr><td>&nbsp;<br></td></tr>
        <tr><td>Thanks & Regards</td></tr>
        <tr><td>Stack Developers</td></tr>
    </table>
</body>

</html>