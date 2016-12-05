<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <meta http-equiv=content-type content="text/html; charset=utf-8" />
        <link href="././css/admin/admin.css" type="text/css" rel="stylesheet" />
        <script language=javascript>
            function expand(el)
            {
                childobj = document.getElementById("child" + el);

                if (childobj.style.display == 'none')
                {
                    childobj.style.display = 'block';
                }
                else
                {
                    childobj.style.display = 'none';
                }
                return;
            }
        </script>
    </head>
    <body>
        <table height="100%" cellspacing=0 cellpadding=0 width=170 
               background=././images/admin/menu_bg.jpg border=0>
               <tr>
                <td valign=top align=middle>
                    <table cellspacing=0 cellpadding=0 width="100%" border=0>

                        <tr>
                            <td height=10></td></tr></table>
                    <table cellspacing=0 cellpadding=0 width=150 border=0>
                        <tr height=22>
                            <td style="padding-left: 30px" background=././images/admin/menu_bt.jpg><a 
                                    class=menuparent onclick=expand(2) 
                                    href="javascript:void(0);">用户管理</a></td></tr>
                        <tr height=4>
                            <td></td></tr></table>
                    <table id=child2 style="display: none" cellspacing=0 cellpadding=0 
                           width=150 border=0>
                        <tr height=20>
                            <td align=middle width=30><img height=9 
                                                           src="././images/admin/menu_icon.gif" width=9></td>
                            <td><a class=menuchild 
                                   href="./index.php?r=admin/user/information" 
                                   target=right>用户信息</a></td></tr>
                        <tr height=4>
                            <td colspan=2></td></tr></table>
                    <table cellspacing=0 cellpadding=0 width=150 border=0>
                        <tr height=22>
                            <td style="padding-left: 30px" background=././images/admin/menu_bt.jpg><a 
                                    class=menuparent onclick=expand(3) 
                                    href="javascript:void(0);">商家管理</a></td></tr>
                        <tr height=4>
                            <td></td></tr></table>
                    <table id=child3 style="display: none" cellspacing=0 cellpadding=0 
                           width=150 border=0>
                        <tr height=20>
                            <td align=middle width=30><img height=9 
                                                           src="././images/admin/menu_icon.gif" width=9></td>
                            <td><a class=menuchild 
                                   href="./index.php?r=admin/business/lists" 
                                   target=right>商家信息</a></td></tr>
                        <tr height=4>
                            <td colspan=2></td></tr></table>
                    <table cellspacing=0 cellpadding=0 width=150 border=0>
                        <tr height=22>
                            <td style="padding-left: 30px" background=././images/admin/menu_bt.jpg><a 
                                    class=menuparent onclick=expand(5) 
                                    href="javascript:void(0);">系统管理</a></td></tr>
                        <tr height=4>
                            <td></td></tr></table>
                    <table id=child5 style="display: none" cellspacing=0 cellpadding=0 
                           width=150 border=0>

                        <tr height=20>
                            <td align=middle width=30><img height=9 
                                                           src="././images/admin/menu_icon.gif" width=9></td>
                            <td><a class=menuchild 
                                   href="./index.php?r=admin/system/lists" 
                                   target=right>管理员列表</a></td></tr>
                        <tr height=20>
                            <td align=middle width=30><img height=9 
                                                           src="././images/admin/menu_icon.gif" width=9></td>
                            <td><a class=menuchild 
                                   href="./index.php?r=admin/system/creat" 
                                   target=right>管理员创建</a></td></tr>
                        <tr height=4>
                            <td colspan=2></td></tr></table>
                    <table cellspacing=0 cellpadding=0 width=150 border=0>

                        <tr height=22>
                            <td style="padding-left: 30px" background=././images/admin/menu_bt.jpg><a 
                                    class=menuparent onclick=expand(6) 
                                    href="javascript:void(0);">店铺管理</a></td></tr>
                        <tr height=4>
                            <td></td></tr></table>
                    <table id=child6 style="display: none" cellspacing=0 cellpadding=0 
                           width=150 border=0>

                        <tr height=20>
                            <td align=middle width=30><img height=9 
                                                           src="././images/admin/menu_icon.gif" width=9></td>
                            <td><a class=menuchild 
                                   href="./index.php?r=admin/stroes/lists" 
                                   target=right>店铺信息</a></td></tr>
                        <tr height=4>
                            <td colspan=2></td></tr></table>
                   
                    <table cellspacing=0 cellpadding=0 width=150 border=0>

                        <tr height=22>
                            <td style="padding-left: 30px" background=././images/admin/menu_bt.jpg><a 
                                    class=menuparent onclick=expand(8) 
                                    href="javascript:void(0);">聊天记录管理</a></td></tr>
                        <tr height=4>
                            <td></td></tr></table>
                    <table id=child8 style="display: none" cellspacing=0 cellpadding=0 
                           width=150 border=0>

                        <tr height=20>
                            <td align=middle width=30><img height=9 
                                                           src="././images/admin/menu_icon.gif" width=9></td>
                            <td><a class=menuchild 
                                   href="./index.php?r=admin/records/records" 
                                   target=right>聊天记录</a></td></tr>
                        <tr height=4>
                            <td colspan=2></td></tr></table>
                    
                    <table cellspacing=0 cellpadding=0 width=150 border=0>

                        <tr height=22>
                            <td style="padding-left: 30px" background=././images/admin/menu_bt.jpg><a 
                                    class=menuparent onclick=expand(9) 
                                    href="javascript:void(0);">商品管理</a></td></tr>
                        <tr height=4>
                            <td></td></tr></table>
                    <table id=child9 style="display: none" cellspacing=0 cellpadding=0 
                           width=150 border=0>

                        <tr height=20>
                            <td align=middle width=30><img height=9 
                                                           src="././images/admin/menu_icon.gif" width=9></td>
                            <td><a class=menuchild 
                                   href="./index.php?r=admin/goods/show" 
                                   target=right>商品管理</a></td></tr>
                        <tr height=4>
                            <td align=middle width=30><img height=9 
                                                           src="././images/admin/menu_icon.gif" width=9></td>
                            <td><a class=menuchild 
                                   href="./index.php?r=admin/shares/lists" 
                                   target=right>分享管理</a></td></tr>
                    </table>
                    <table cellspacing=0 cellpadding=0 width=150 border=0>

                        <tr height=22>
                            <td style="padding-left: 30px" background=././images/admin/menu_bt.jpg><a 
                                    class=menuparent onclick=expand(10) 
                                    href="javascript:void(0);">交易管理</a></td></tr>
                        <tr height=4>
                            <td></td></tr></table>
                    <table id=child10 style="display: none" cellspacing=0 cellpadding=0 
                           width=150 border=0>

                        <tr height=20>
                            <td align=middle width=30><img height=9 
                                                           src="././images/admin/menu_icon.gif" width=9></td>
                            <td><a class=menuchild 
                                   href="./index.php?r=admin/deals/show" 
                                   target=right>交易记录管理</a></td></tr>
                        <tr height=4>
                            <td colspan=2></td></tr>
                    </table>
                    
                    
                    <table id=child0 style="display: none" cellspacing=0 cellpadding=0 
                           width=150 border=0>
                        <tr height=20>
                            <td align=middle width=30><img height=9 
                                                           src="././images/admin/menu_icon.gif" width=9></td>
                            <td><a class=menuchild 
                                   onclick="if (confirm('确定要退出吗？')) return true; else return false;" 
                                   href="./index.php?r=admin/manager/logout" 
                                   target=_top>退出系统</a></td></tr></table></td>
                <td width=1 bgcolor=#d1e6f7></td>
            </tr>
        </table>
    </body>
</html>