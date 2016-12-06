<?php
/**
 * @Tool: PhpStorm.
 * @Company:
 * @Author: ldz
 * @Since: 2016/10/9 0:12
 * @Description: 描述 存放全局函数
 */
//include_once('./Plugin/SMSPHP_v2.6r/SendTemplateSMS.php');
include_once("./Plugin/SMSPHP_v2.6r/CCPRestSmsSDK.php");
require_once("./Plugin/PHPExcel/PHPExcel.php");
<<<<<<< HEAD
/* require_once("./Plugin/PHPExcel/PHPExcel/Writer/Excel5"); */
=======
>>>>>>> origin/master
require_once("./Plugin/PHPExcel/PHPExcel/IOFactory.php");

/*require_once(APP_PATH . '/Common/Common/extend.php');*/


/**
 * Excel导出数据(所有数组均为键名为数字序列号)
 * @param array $headerArr
 * @param array $dataArr (暂只支持2维数组格式)
 * @param string $filename
 * @param array $appendArr(用于追加表格内容尾部)
 * @param boolean $isDate (非必填 默认文件加日期)
 * @param int $sheetIndex (非必填 默认页码为0)
 * @throws Exception
 * @throws PHPExcel_Exception
 * @throws PHPExcel_Reader_Exception
 */
function exportExcel($headerArr, $dataArr, $filename, $appendArr = array(), $isDate = true, $sheetIndex = 0)
{
//    import("Org.Util.PHPExcel");
//    import("Org.Util.PHPExcel.Writer.Excel5");
//    import("Org.Util.PHPExcel.Writer.PDF");
//    import("Org.Util.PHPExcel.IOFactory.php");
    if (empty($filename)) {
        throw  new Exception('filename is empty');
    }
    if (empty($dataArr)) {
        throw  new Exception('excel data is empty');
    }
    if (empty($headerArr)) {
        throw  new Exception('excel header is empty');
    }
    $date = '';
    if ($isDate) {
        $date = '_'.date('Y_m_d',time());
    }
    $phpExcelObj = new \PHPExcel();

    // Set properties  设置文件属性(对应右键文件查看属性)
    $phpExcelObj->getProperties()
        ->setCreator("TAM-CHING-LOL")
        ->setLastModifiedBy("TAM-CHING-LOL")
        ->setTitle("TAM-CHING-LOL PHPExcel Document")
        ->setSubject("TAM-CHING-LOL PHPExcel Document")
        ->setDescription("TAM-CHING-LOL PHPExcel Document")
        ->setKeywords("TAM-CHING-LOL PHPExcel Document")
        ->setCategory("TAM-CHING-LOL PHPExcel Document");

    $phpExcelObj->setActiveSheetIndex($sheetIndex);     //设置存在表的页数/位置
    $phpExcelSheet = $phpExcelObj->getActiveSheet();    //获取设置的表的页数/位置
    $col = ord('A');                                    //列号(excel列是从A开始)
    $col21 = ord('A');
    //设置列宽
    foreach ($headerArr as $k => $v) {
        $col1 = chr($col);
        $phpExcelSheet->getColumnDimension($col1)->setWidth(20);
        $col++;
    }
    //设置表头
    foreach ($headerArr as $k => $v) {
        $col2 = chr($col21);
        $phpExcelSheet->setCellValue($col2 . '1', $v);
        $phpExcelSheet->getRowDimension('1')->setRowHeight(25);
        $phpExcelSheet->getStyle($col2 . '1')->getFont()->setSize(12);
        $phpExcelSheet->getStyle($col2 . '1')->getFont()->setName('kaiti');
        $phpExcelSheet->getStyle($col2 . '1')->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_BLUE);
        $col21++;
    }
    //设置表内容
    $dataRow = 2;
    foreach ($dataArr as $k1 => $row) {     //行
        $col31 = ord('A');
        foreach ($row as $k => $v) {        //列
            $col3 = chr($col31);
            $phpExcelSheet->setCellValue($col3 . ($dataRow + $k1), $v);
            $col31++;
        }
        $phpExcelSheet->getRowDimension($dataRow + $k1)->setRowHeight(22);
    }
    //表内容尾部追加
    if(!empty($appendArr)){
        $appendRow = count($dataArr) + $dataRow;
        $col41 = ord('A');
        //一维数组追加
        if(!empty($appendArr[0]) && !is_array($appendArr[0])){
            foreach($appendArr as $k => $v){
                $phpExcelSheet->setCellValue(chr($col41).$appendRow,$v);
                $phpExcelSheet->getStyle(chr($col41).$appendRow)->getFont()->setSize(12);
                $phpExcelSheet->getStyle(chr($col41).$appendRow)->getFont()->setBold(true);
                $phpExcelSheet->getStyle(chr($col41).$appendRow)->getFont()->setName('kaiti');
                $phpExcelSheet->getStyle(chr($col41).$appendRow)->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_RED);
                $col41++;
            }
            $phpExcelSheet->getRowDimension($appendRow)->setRowHeight(22);
            //二维数组追加
        }else{
            foreach ($appendArr as $k1 => $row) {       //行
                $col41 = ord('A');
                foreach ($row as $k => $v) {            //列
                    $col4 = chr($col41);
                    $phpExcelSheet->setCellValue($col4 . ($appendRow + $k1), $v);
                    $col41++;
                }
                $phpExcelSheet->getRowDimension($appendRow + $k1)->setRowHeight(22);
            }
        }
    }

    //设置Excel默认打开是第一张表
    $phpExcelObj->setActiveSheetIndex(0);
    $filename .= "{$date}.xls";
    $filename = iconv("utf-8", "gb2312", $filename);
    ob_end_clean();         //清除缓冲区
    header("Content-type:application/octet-stream");
    header("Accept-Ranges:bytes");
    header("Content-type:application/vnd.ms-excel;charset=utf-8");
    header("Content-Disposition:attachment;filename=\"$filename\"");
    header('Cache-Control: max-age=0');
    header("Pragma: no-cache");
    header("Expires: 0");
    $objWriter = \PHPExcel_IOFactory::createWriter($phpExcelObj, 'Excel5');
    $objWriter->save('php://output');   //浏览器下载
    exit;
}

/**
 *Excel导入数据
 */
function importExcel(){

}

/**
 *生成图片验证码
 */
function makeVerify(){
    ob_end_clean();         //会清除缓冲区的内容，并将缓冲区关闭
    $config = array(
//            'expire' =>
        'fontSize' => 35,   // 验证码字体大小
        'length' => 4,      // 验证码位数
        'bg' => array(255, 255, 255),
        'useCurve' => false, // 关闭曲线干扰
    );
    $verify = new \Think\Verify($config);
    $verify->entry();
}

/**
 * 遍历数组保存session值
 * @param $infoArray
 */
function sessionSave($infoArray){
    if(!empty($infoArray) && is_array($infoArray)){
        foreach($infoArray as $k => $v){
            session($k,$v);
        }
    }
}

/**
 *检验tp自带验证码
 * @param $code
 * @return bool
 */
function checkVerify($code){
    $verify = new \Think\Verify();
    if(empty($code)){
        return false;
        exit;
    }
    if(!$verify->check($code)){
        return false;
        exit;
    }
    return true;
}

/**
 * 随机生成短信验证码
 * @param int $length
 * @return int
 */
function makeSmsCode($length = 7){
    $min = pow(10,($length - 2));
    $max = pow(10,($length - 1));
    return mt_rand($min,$max);
}

/**
 * 生成各种系统编号
 * @param $sysTag
 * @param $id
 * @return string
 */
function makeEveryNumber($sysTag,$id) {
    if(empty($sysTag)){ return '系统标识为空'; exit;}
    $idLength = strlen(strval($id));
    $date = date('ymd');
    $str = $sysTag.$date;
    $length = 7 - $idLength;
    $strPol = "0123456789";
    $max = strlen($strPol) - 1;
    $str1 = null;
    for ($i = 0; $i < $length; $i++) {
        $str1 .= $strPol[mt_rand(0, $max)];            //rand($min,$max)生成介于min和max两个数之间的一个随机整数
    }
    $str .= $str1.$id;
    return $str;
}


/**
 * 加盐N位数随机算法
 * @param $length
 * @return string
 */
function getRandStr($length) {
    $chars = array(
        "a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k",
        "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v",
        "w", "x", "y", "z", "A", "B", "C", "D", "E", "F", "G",
        "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R",
        "S", "T", "U", "V", "W", "X", "Y", "Z", "0", "1", "2",
        "3", "4", "5", "6", "7", "8", "9"
    );
    $charsLen = count($chars) - 1;
    shuffle($chars);                    //将数组打乱
    $output = "";
    for ($i = 0; $i < $length; $i++) {
        $output .= $chars[mt_rand(0, $charsLen)];       //mt_rand($min,$max)生成一个更好的随机数
    }
    return $output;
}

/**
 * 发送模板短信[云通讯插件]
 * @param $to :手机号码集合,用英文逗号分开
 * @param $data :内容数据 格式为数组 例如：array('Marry','Alon')，如不需替换请填 null
 * @param $tempId :模板Id,测试应用和未上线应用使用测试模板请填写1，正式应用上线后填写已申请审核通过的模板ID
 * @return string
 */
function sendTemplateSMS($to,$data,$tempId)
{
    global $accountSid,$accountToken,$appId,$serverIP,$serverPort,$softVersion;
    //主帐号,对应开官网发者主账号下的 ACCOUNT SID
    $accountSid= '8a216da857a253ce0157acc867d1092a';

    //主帐号令牌,对应官网开发者主账号下的 AUTH TOKEN
    $accountToken= '679ae7fcf4de439a87fe064c63d06666';

    //应用Id，在官网应用列表中点击应用，对应应用详情中的APP ID
    //在开发调试的时候，可以使用官网自动为您分配的测试Demo的APP ID
    $appId='8a216da857a253ce0157acc868760930';

    //请求地址
    //沙盒环境（用于应用开发调试）：sandboxapp.cloopen.com
    //生产环境（用户应用上线使用）：app.cloopen.com
    $serverIP='sandboxapp.cloopen.com';
//    $serverIP='app.cloopen.com';

    //请求端口，生产环境和沙盒环境一致
    $serverPort='8883';
    //REST版本号，在官网文档REST介绍中获得。
    $softVersion='2013-12-26';

    // 初始化REST SDK
    $rest = new REST($serverIP,$serverPort,$softVersion);
    $rest->setAccount($accountSid,$accountToken);
    $rest->setAppId($appId);

    // 发送模板短信
    //     echo "Sending TemplateSMS to $to <br/>";
    $result = $rest->sendTemplateSMS($to,$data,$tempId);
    if($result == NULL ) {
        echo "result error!";
        exit();
    }
    if($result->statusCode!=0) {
//        echo "error code :" . $result->statusCode . "<br>";
//        echo "error msg :" . $result->statusMsg . "<br>";
        //TODO 添加错误处理逻辑
        return 'failSms';
    }else{
//        $smsmessage = $result->TemplateSMS;
//        echo "dateCreated:".$smsmessage->dateCreated."<br/>";
//        echo "smsMessageSid:".$smsmessage->smsMessageSid."<br/>";
        //TODO 添加成功处理逻辑
        return 'successSms';
    }
}

/**
 * 发送验证码/获取验证码
 * @param $phone
 * @param int $tempId
 * @param int $type
 * @param string $msg_id
 * @return mixed|string
 */
function sendSms($phone, $tempId = 1, $type = 1, $msg_id = ''){
    $AppKey = 'eae98d047829d7a686bc8e81';
    $MasterSecret = 'a87e103ac99702e40e25ff8f';
    try{
        if($type === 1){        //发送验证码操作
            $url = 'https://api.sms.jpush.cn/v1/codes';
            $dataArray = array(
                'mobile' => $phone,
                'temp_id' => $tempId
            );
            $data = json_encode($dataArray);
            $Authorization = base64_encode($AppKey . ":" . $MasterSecret);
            $head = array("Accept:application/json","Content-Type:application/json;charset=utf-8","Authorization: Basic $Authorization");
        }else{                  //获取验证码操作
            $url = 'https://api.sms.jpush.cn/v1/codes/$msg_id/valid';
            $data = '{}';
            $Authorization = base64_encode("$AppKey : $MasterSecret");
            $head = array("Accept:application/json","Content-Type:application/json;charset=utf-8","Authorization: Basic $Authorization");
        }
        $result = smsCurlPost($url,$data,$head);
        return json_decode($result);
    }catch(Exception $e){
        return $e->getMessage();
    }

}

/**
 * 短信接口链接请求
 * @param $url
 * @param $data
 * @param $header
 * @param int $post
 * @return mixed
 */
function smsCurlPost($url, $data, $header = array(), $post = 1){

    try{
        $ch = curl_init();                                  //curl初始化
        curl_setopt($ch,CURLOPT_URL,$url);                  //抓取指定网页
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);    //终止从服务端进行验证
        curl_setopt ($ch, CURLOPT_HEADER, 0);               //设置header
        curl_setopt($ch, CURLOPT_POST, $post);              //post提交方式
        if($post){
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);   //要求结果为字符串且输出到屏幕上
            curl_setopt($ch,CURLOPT_HTTPHEADER,$header);    // 增加 HTTP Header字段
        }
        $result = curl_exec ($ch);                          //curl运行
        if(!$result){
            $tips['statusCode'] = '4040';
            $tips['errorCode'] = '网络错误';
            $result = json_encode($tips);
        }
        curl_close($ch);
        return $result;
    }catch(Exception $e){
        return $e->getMessage();
    }
}
