<?php
require('include/sidebar.php');
?>

<div class='ct' id=u3>
    <div class=cnt><div>

    <table class=tinf>
            <tbody>
                <tr>
                    <td class=tp>Role</td>
                    <td class=inf><?php echo $_SESSION['ROLE']; ?></td>
                </tr>
                <tr>
                    <td class=tp>Seisure Name</td>
                    <td class=inf><?php echo $_SESSION['NAME']; ?></td>
                </tr>
                <tr>
                    <td class=tp>Departement</td>
                    <td class=inf><?php echo $_SESSION['DEPT']; ?></td>
                </tr>
                <tr>
                    <td class=tp>Plant</td>
                    <td class=inf><?php echo $_SESSION['PLANT']; ?></td>
                </tr>
            </tbody>
        </table><br>

        <form class=frm action="find_transfer.php" method="POST" autocomplete=off>
            <input autofocus id=uname type=text name=code placeholder="code job request" class='tai' require><br>
            <input name=submit type=submit value=Find class=bnt>
        </form>

    
<table class=tinf>
    <tbody>
        <tr>
            <td class=tp>WD ID</td>
            <td class=inf></td>
        </tr>
        <tr>
            <td class=tp>Employee's Name</td>
            <td id=x0 class=inf></td>
        </tr>
        <tr>
            <td class=tp>Departement</td>
            <td id=x2 class=inf></td>
        </tr>
        <tr>
            <td class=tp>Old Position</td>
            <td id=x3 class=inf></td>
        </tr>
    </tbody>
</table><br>



<table class=tinf>
    <tbody>
        <tr>
            <td class=tp>Giver Plant</td>
            <td class=inf id=giv></td>
        </tr>
        <tr>
            <td class=tp>Giver Manager</td>
            <td id=x4 class=inf></td>
        </tr>
        <tr>
            <td class=tp>Giver Country Manager</td>
            <td id=x5 class=inf></td>
        </tr>
        <tr>
            <td class=tp>Giver HR Manager</td>
            <td id=x6 class=inf></td>
        </tr>
        <tr>
            <td class=tp>Giver Plant Manager</td>
            <td id=x7 class=inf></td>
        </tr>
    </tbody>
</table><br>

<table class=tinf>
    <tbody>
        <tr>
            <td class=tp>Job Requesition</td>
            <td class=inf></td>
        </tr>
        <tr>
            <td class=tp>Departement</td>
            <td class=inf id=y1></td>
        </tr>
        <tr>
            <td class=tp>New Position</td>
            <td class=inf id=y2></td>
        </tr>
    </tbody>
</table><br>


<table class=tinf>
    <tbody>
        <tr>
            <td class=tp>Receiver Plant</td>
            <td class=inf id=rec></td>
        </tr>
        <tr>
            <td class=tp>Receiver Manager</td>
            <td class=inf id=y5></td>
        </tr>
        <tr>
            <td class=tp>Receiver Country Manager</td>
            <td class=inf id=y6></td>
        </tr>
        <tr>
            <td class=tp>Receiver HR Manager</td>
            <td class=inf id=y7></td>
        </tr>
        <tr>
            <td class=tp>Receiver Plant Manager</td>
            <td class=inf id=y8></td>
        </tr>
    </tbody>
</table><br>

<table class=tinf>
    <tbody>
        <tr>
            <td class=tp>HR NA Director</td>
            <td class=inf id=y9></td>
        </tr>
        <tr>
            <td class=tp>Ops NA Director</td>
            <td class=inf id=y10></td>
        </tr>
    </tbody>
</table>

</div>



<div class=avnc id=met></div>
</div>
</div>
</div>


<script type="text/javascript">
users=[
        ["Dev Team of Giver Plant","---/--/--"],
        ["Giver Manager","---/--/--"],
        ["Receiver Manager","---/--/--"],
        ["Giver HR Manager","---/--/--"],
        ["Receiver HR Manager","---/--/--"],
        ["Giver Plant Manager","---/--/--"],
        ["Recv. Plant Manager","---/--/--"],
        ["Giver Country Manager","---/--/--"],
        ["Recv. Country Manager","---/--/--"],
        ["HR Director NA","---/--/--"],
        ["Operations Director NA","---/--/--"]
    ];


function meth()
{
    var nxt=1,rej=0,a="",n="pd";
    for(fum="",i=0;i<users.length;i++)
    {
        s=0==i?"":"<div class='br "+a+"'></div>",fum+=s+"<div><div class='date "+n+"'>"+users[i][1]+"</div><div class='aprv "+a+"'>"+users[i][0]+"</div></div>"
    }
    document.getElementById("met").innerHTML=fum;
}

meth();

</script>