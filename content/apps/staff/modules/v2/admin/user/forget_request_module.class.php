<?php
//
//    ______         ______           __         __         ______
//   /\  ___\       /\  ___\         /\_\       /\_\       /\  __ \
//   \/\  __\       \/\ \____        \/\_\      \/\_\      \/\ \_\ \
//    \/\_____\      \/\_____\     /\_\/\_\      \/\_\      \/\_\ \_\
//     \/_____/       \/_____/     \/__\/_/       \/_/       \/_/ /_/
//
//   上海商创网络科技有限公司
//
//  ---------------------------------------------------------------------------------
//
//   一、协议的许可和权利
//
//    1. 您可以在完全遵守本协议的基础上，将本软件应用于商业用途；
//    2. 您可以在协议规定的约束和限制范围内修改本产品源代码或界面风格以适应您的要求；
//    3. 您拥有使用本产品中的全部内容资料、商品信息及其他信息的所有权，并独立承担与其内容相关的
//       法律义务；
//    4. 获得商业授权之后，您可以将本软件应用于商业用途，自授权时刻起，在技术支持期限内拥有通过
//       指定的方式获得指定范围内的技术支持服务；
//
//   二、协议的约束和限制
//
//    1. 未获商业授权之前，禁止将本软件用于商业用途（包括但不限于企业法人经营的产品、经营性产品
//       以及以盈利为目的或实现盈利产品）；
//    2. 未获商业授权之前，禁止在本产品的整体或在任何部分基础上发展任何派生版本、修改版本或第三
//       方版本用于重新开发；
//    3. 如果您未能遵守本协议的条款，您的授权将被终止，所被许可的权利将被收回并承担相应法律责任；
//
//   三、有限担保和免责声明
//
//    1. 本软件及所附带的文件是作为不提供任何明确的或隐含的赔偿或担保的形式提供的；
//    2. 用户出于自愿而使用本软件，您必须了解使用本软件的风险，在尚未获得商业授权之前，我们不承
//       诺提供任何形式的技术支持、使用担保，也不承担任何因使用本软件而产生问题的相关责任；
//    3. 上海商创网络科技有限公司不对使用本产品构建的商城中的内容信息承担责任，但在不侵犯用户隐
//       私信息的前提下，保留以任何方式获取用户信息及商品信息的权利；
//
//   有关本产品最终用户授权协议、商业授权与技术服务的详细内容，均由上海商创网络科技有限公司独家
//   提供。上海商创网络科技有限公司拥有在不事先通知的情况下，修改授权协议的权力，修改后的协议对
//   改变之日起的新授权用户生效。电子文本形式的授权协议如同双方书面签署的协议一样，具有完全的和
//   等同的法律效力。您一旦开始修改、安装或使用本产品，即被视为完全理解并接受本协议的各项条款，
//   在享有上述条款授予的权力的同时，受到相关的约束和限制。协议许可范围以外的行为，将直接违反本
//   授权协议并构成侵权，我们有权随时终止授权，责令停止损害，并保留追究相关责任的权力。
//
//  ---------------------------------------------------------------------------------
//
defined('IN_ECJIA') or exit('No permission resources.');

/**
 * 忘记密码请求
 * @author will
 */
class v2_admin_user_forget_request_module extends api_admin implements api_interface {
    public function handleRequest(\Royalcms\Component\HttpKernel\Request $request) {
    		
		$this->authadminSession();
		$admin_username = $this->requestData('username');
		$type = $this->requestData('type');
		$type_info    = $this->requestData('type_info');
		
		if (empty($type) || empty($type_info)) {
		    return  new ecjia_error('empty_error', __('请填写用户相关信息！'));
		}
		if ($type == "email") {
	        $preg = '/^([a-zA-Z0-9_\-\.])+@([a-zA-Z0-9_-])+((\.[a-zA-Z0-9_-]{2,3}){1,2})$/i';
	        if (!preg_match($preg, $type_info)) {
		        return new ecjia_error('email_error', __('邮箱格式不正确！'));
		    }
		}
		if ($type == "mobile") {
// 		    if(! preg_match('/^1[345678]{1}\d{9}$/', $type_info)){
// 		        return new ecjia_error('mobile_error', __('手机号格式不正确！'));
// 		    }
		    $check_mobile = Ecjia\App\Sms\Helper::check_mobile($type_info);
		    if (is_ecjia_error($check_mobile)) {
		        return $check_mobile;
		    }
		}
		
		//根据用户名判断是商家还是平台管理员
		//如果商家员工表存在，以商家为准
		if ($type == "email") {
		    $row_staff = RC_DB::table('staff_user')->where('email', $type_info)->first();
		} else if ($type == "mobile") {
		    $row_staff = RC_DB::table('staff_user')->where('mobile', $type_info)->first();
		}
		
		if ($row_staff) {
		    //商家
		    return $this->forget_request_merchant($admin_username, $type, $type_info);
		} else {
		    //平台
		    return $this->forget_request_admin($admin_username, $type, $type_info);
		}
		
		
	    
	}
	
	private function forget_request_merchant($admin_username, $type, $type_info) {
	    if ($type == "email") {
	        $user_id = RC_DB::Table('staff_user')->where('email', $type_info)->pluck('user_id');
	
	        if (!empty($user_id)) {
	            $code    = rand(111111, 999999);
	            $content = "[".ecjia::config('shop_name')."]您的管理员账户正在变更账户信息，效验码：".$code."，打死都不能告诉别人哦！唯一热线".ecjia::config('service_phone');
	            /* 发送确认重置密码的确认邮件 */
	            if (RC_Mail::send_mail($admin_username, $type_info, '账户变更效验码', $content, 1)) {
	                $_SESSION['temp_code']      = $code;
	                $_SESSION['temp_code_time'] = RC_Time::gmtime();
	                $data = array(
	                    'uid' => $user_id,
	                    'sid' => RC_Session::session_id(),
	                );
	                 
	                return $data;
	            } else {
	                return new ecjia_error('post_email_error', __('邮件发送失败！'));
	            }
	        } else {
	            /* 提示信息 */
	            return new ecjia_error('userinfo_error', __('用户不存在！'));
	        }
	    } else if ($type == "mobile") {
	
	        $mobile = $type_info;
	        $user_id = RC_DB::Table('staff_user')->where('mobile', $mobile)->pluck('user_id');
	
	        if (!empty($user_id)) {
	            $code      = rand(111111, 999999);
	            $options = array(
            		'mobile' => $mobile,
            		'event'	 => 'sms_get_validate',
            		'value'  =>array(
            				'code' 			=> $code,
            				'service_phone' => ecjia::config('service_phone'),
            		),
	            );
	            $response = RC_Api::api('sms', 'send_event_sms', $options);
	            
	            $_SESSION['user_id'] 	    = $user_id;
	            $_SESSION['temp_code'] 	    = $code;
	            $_SESSION['temp_code_time'] = RC_Time::gmtime();
	            
	            if (is_ecjia_error($response)) {
	            	return $response;
	            } else {
                    $data = array(
                        'uid' => $user_id,
                        'sid' => RC_Session::session_id(),
                    );
                    return $data;
	            }
	        } else {
	            /* 提示信息 */
	            return new ecjia_error('userinfo_error', __('用户不存在！'));
	        }
	    }
	}
	
	private function forget_request_admin($admin_username, $type, $type_info) {
	    if ($type == "email") {
	        //$db = RC_Model::model('user/admin_user_model');
	        /* 管理员用户名和邮件地址是否匹配，并取得原密码 */
	        //$admin_info = $db->field('user_id, password')->find(array('user_name' => $admin_username, 'email' => $type_info));
	    	$admin_info	  = RC_DB::table('admin_user')->select('user_id', 'password')->where('user_name', $admin_username)->where('email', $type_info)->first();
	    	
	        if (!empty($admin_info)) {
	            $code    = rand(111111, 999999);
	            $content = "[".ecjia::config('shop_name')."]您的管理员账户正在变更账户信息，效验码：".$code."，打死都不能告诉别人哦！唯一热线".ecjia::config('service_phone');
	            /* 发送确认重置密码的确认邮件 */
	            if (RC_Mail::send_mail($admin_username, $type_info, '账户变更效验码', $content, 1)) {
	                $_SESSION['temp_code']      = $code;
	                $_SESSION['temp_code_time'] = RC_Time::gmtime();
	                $data = array(
	                    'uid' => $admin_info['user_id'],
	                    'sid' => RC_Session::session_id(),
	                );
	                 
	                return $data;
	            } else {
	                return new ecjia_error('post_email_error', __('邮件发送失败！'));
	            }
	        } else {
	            /* 提示信息 */
	            return new ecjia_error('userinfo_error', __('用户名与其信息不匹配！'));
	        }
	    }
	}
}

// end