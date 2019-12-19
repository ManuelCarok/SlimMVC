<?php

namespace Lib;

class Slack {
	private $token = '';
	
	public function __construct() {}
	
	public function sendMessage($channel, $message) {
		$ch = curl_init("https://slack.com/api/chat.postMessage");
		$data = http_build_query([
			"token" => $this->token,
			"channel" => $channel,
			"text" => $message,
			"icon_emoji" => ":byteservicesbot:",
			"username" => "ByteServices Web"
		]);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		$result = curl_exec($ch);
		curl_close($ch);
		
		return $result;
	}
	
	public function sendBlock($channel, $message) {
		// mrkdwn, plain_text, https://api.slack.com/reference/messaging/blocks
		
		$ch = curl_init("https://slack.com/api/chat.postMessage");
		$data = http_build_query([
			"token" => $this->token,
			"channel" => $channel,
			"text" => "<@channel>",
			"blocks" => json_encode([
				[
					"type" => "section",
					"text" =>  [
						"type" => "mrkdwn",
						"text" => $message
					]
				]
			]),  
			"icon_emoji" => ":byteservicesbot:",
			"username" => "ByteServices Web"
		]);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		$result = curl_exec($ch);
		curl_close($ch);
		
		return $result;
	}
	
	public function sendAttachments($channel, $author, $mail, $message, $fields = []) {
		$ch = curl_init("https://slack.com/api/chat.postMessage");
		$data = http_build_query([
			"token" => $this->token,
			"channel" => $channel,
			"attachments" => json_encode([
				[
					"mrkdwn_in" => ["text"],
					"color" => "#2eb886",
					"pretext" => "Nuevo Correo <!channel>",
					"author_name" => $author,
					"author_link" => "http://byteservices.cl/img/footer-logo.png",
					"author_icon" => "http://byteservices.cl/img/footer-logo.png",
					"title" => "Responder",
					"title_link" => "mailto:".$mail,
					"text" => "Mensaje enviado de la web.",
					"fields" =>  $fields,
					//"image_url" => "http://byteservices.cl/img/footer-logo.png",
					//"thumb_url" => "http://byteservices.cl/img/footer-logo.png",
					"footer" => "ByteServices",
					"footer_icon" => "http://byteservices.cl/img/footer-logo.png",
					"ts" => strtotime("now")
				]
			]),  
			"icon_emoji" => ":byteservicesbot:",
			"username" => "ByteServices Web"
		]);
		
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		$result = curl_exec($ch);
		curl_close($ch);
		
		return $result;
	}
}