<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="en">
<?php $this->load->view('mailers/common/view_include');?>

<body style="margin:0; padding:0;" bgcolor="#F0F0F0" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">

<table border="0" width="100%" height="100%" cellpadding="0" cellspacing="0" bgcolor="#F0F0F0">
    <tr>
        <td align="center" valign="top" bgcolor="#F0F0F0" style="background-color: #F0F0F0;">
            <table border="0" width="600" cellpadding="0" cellspacing="0" class="container" style="width:600px;max-width:600px; padding-left:24px;padding-right:24px;padding-top:12px;padding-bottom:12px;background-color:#ffffff; margin: 10px 0" >
                <?php $this->load->view('mailers/common/view_header');?>

                <tr>
                    <td class="container-padding content" align="left" style="">
                        <br>
                        <div class="title" style="font-family:Helvetica, Arial, sans-serif;font-size:18px;font-weight:600;color:#374550">Two Columns (simple)</div>
                        <br>

                        <div class="body-text" style="font-family:Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;text-align:left;color:#333333">
                            This is an example of transforming two columns on desktop into rows on mobile.
                            <br><br>
                        </div>

                        <div class="hr" style="height:1px;border-bottom:1px solid #cccccc">&nbsp;</div>
                        <br>

                        <!-- example: two columns (simple) -->

                        <!--[if mso]>
                        <table border="0" cellpadding="0" cellspacing="0" width="100%">
                            <tr><td width="50%" valign="top"><![endif]-->

                        <table width="264" border="0" cellpadding="0" cellspacing="0" align="left" class="force-row">
                            <tr>
                                <td class="col" valign="top" style="font-family:Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;text-align:left;color:#333333;width:100%">
                                    <strong>Herman Melville</strong>
                                    <br><br> It's worse than being in the whirled woods, the last day of the year! Who'd go climbing after chestnuts now? But there they go, all cursing, and here I don't.
                                    <br><br>
                                </td>
                            </tr>
                        </table>

                        <!--[if mso]></td><td width="50%" valign="top"><![endif]-->

                        <table width="264" border="0" cellpadding="0" cellspacing="0" align="right" class="force-row">
                            <tr>
                                <td class="col" valign="top" style="font-family:Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;text-align:left;color:#333333;width:100%">
                                    <strong>I am Ishmael</strong>
                                    <br><br> White squalls? white whale, shirr! shirr! Here have I heard all their chat just now, and the white whale—shirr! shirr!—but spoken of once! and…
                                    <br><br>
                                </td>
                            </tr>
                        </table>

                        <!--[if mso]></td></tr></table><![endif]-->


                        <!--/ end example -->

                        <div class="hr" style="height:1px;border-bottom:1px solid #cccccc;clear: both;">&nbsp;</div>
                        <br>

                        <div class="subtitle" style="font-family:Helvetica, Arial, sans-serif;font-size:16px;font-weight:600;color:#2469A0">
                            Code Walkthrough
                        </div>

                        <div class="body-text" style="font-family:Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;text-align:left;color:#333333">
                            <ol>
                                <li>
                                    Create a columns container <code style="background-color:#eee;padding:0 4px;font-family:Menlo, Courier, monospace;font-size:12px">&lt;table&gt;</code> just for Outlook using <code style="background-color:#eee;padding:0 4px;font-family:Menlo, Courier, monospace;font-size:12px">if mso</code> conditionals.<br> The container's <code style="background-color:#eee;padding:0 4px;font-family:Menlo, Courier, monospace;font-size:12px">&lt;td&gt;</code>'s have a width of <code style="background-color:#eee;padding:0 4px;font-family:Menlo, Courier, monospace;font-size:12px">50%.</code>
                                    <br><br>
                                </li>
                                <li>
                                    Wrap our columns in a <code style="background-color:#eee;padding:0 4px;font-family:Menlo, Courier, monospace;font-size:12px">&lt;table&gt;</code> with a <strong>fixed width</strong> of <code style="background-color:#eee;padding:0 4px;font-family:Menlo, Courier, monospace;font-size:12px">264px</code>.
                                    <ul>
                                        <li>
                                            264px = (600 - 24*3) / 2 - container width minus margins divided by number of columns
                                        </li>
                                        <li>
                                            First table is aligned left.
                                        </li>
                                        <li>
                                            Second table is aligned right.
                                        </li>
                                    </ul>
                                    <br>
                                </li>
                                <li>
                                    Apply <code style="background-color:#eee;padding:0 4px;font-family:Menlo, Courier, monospace;font-size:12px">clear: both;</code> to first element after our wrapper table.
                                </li>
                            </ol>

                            <br>
                            <em><small>Last updated: 10 October 2014</small></em>
                        </div>

                        <br>
                    </td>
                </tr>

                <?php $this->load->view('mailers/common/view_footer');?>
            </table>




        </td>
    </tr>
</table>
</body>

</html>