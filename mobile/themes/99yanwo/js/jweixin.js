 /*
   * ע�⣺
   * 1. ���е�JS�ӿ�ֻ���ڹ��ںŰ󶨵������µ��ã����ںſ�������Ҫ�ȵ�¼΢�Ź���ƽ̨���롰���ں����á��ġ��������á�����д��JS�ӿڰ�ȫ��������
   * 2. ��������� Android ���ܷ����Զ������ݣ��뵽�����������µİ����ǰ�װ��Android �Զ������ӿ��������� 6.0.2.58 �汾�����ϡ�
   * 3. �������⼰���� JS-SDK �ĵ���ַ��http://mp.weixin.qq.com/wiki/7/aaa137b55fb2e0456bf8dd9148dd613f.html
   *
   * ������������������ĵ�����¼5-�������󼰽���취�����������δ�ܽ����ͨ����������������
   * �����ַ��weixin-open@qq.com
   * �ʼ����⣺��΢��JS-SDK��������������
   * �ʼ�����˵�����ü��������������������ڣ��������������������ĳ������ɸ��Ͻ���ͼƬ��΢���Ŷӻᾡ�촦����ķ�����
   */
  wx.config({
    debug: false,
    appId: '{$signPackage.appId}',
    timestamp: '{$signPackage.timestamp}',
    nonceStr: '{$signPackage.nonceStr}',
    signature: '{$signPackage.signature}',
    jsApiList: [
      // ����Ҫ���õ� API ��Ҫ�ӵ�����б���
	  'checkJsApi',      
      'onMenuShareAppMessage',
      'hideAllNonBaseMenuItem',
      'showMenuItems'      
    ]
  });
  wx.ready(function () {
    // ��������� API
	wx.checkJsApi({
    jsApiList: [        
		'onMenuShareAppMessage'
    ],
   success: function (res) {
         //alert(JSON.stringify(res));
         //alert(JSON.stringify(res.checkResult.getLocation));
        if (res.checkResult.getLocation == false) {
            alert('���΢�Ű汾̫�ͣ���֧��΢��JS�ӿڣ������������µ�΢�Ű汾��');
            return;
        }else{
      
	wx.hideAllNonBaseMenuItem({
      success: function () {
        //alert('���������зǻ����˵���');
           wx.showMenuItems({
      menuList: [        
        'menuItem:share:appMessage' // ���͸�����        
      ],
      success: function (res) {
        //alert('����ʾ���Ķ�ģʽ��������������Ȧ�������������ӡ��Ȱ�ť');
      },
      fail: function (res) {
        alert(JSON.stringify(res));
      }
   	 });
    
      }
    });
        		
	wx.onMenuShareAppMessage({
      title: '99�����ѡ�������������ʱ�ͣ�100����������������飡',
      desc: '����ʱ�� ��֤����������Ʒ�ʺͿڸУ��������ѻƽ�������-̩�������',
      link: 'http://wap.woimai.com/mobile/index.php?m=default&c=sell&a=index&type=hongbao&fuserid='+{$fuserid},
      imgUrl: 'http://wap.woimai.com/mobile/themes/99yanwo/image/youhui60.png',
      trigger: function (res) {
        // ��Ҫ������trigger��ʹ��ajax�첽�����޸ı��η�������ݣ���Ϊ�ͻ��˷��������һ��ͬ����������ʱ��ʹ��ajax�Ļذ��ỹû�з���
        //alert('�û�������͸�����');
      },
      success: function (res) {
        //alert('�ѷ���');
        $(".blackbox").hide();
      },
      cancel: function (res) {
        //alert('��ȡ��');
      },
      fail: function (res) {
        //alert(JSON.stringify(res));
      }
    });
    
	
		
		}
    }
});

  });