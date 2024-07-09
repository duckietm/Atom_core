<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * The items to insert into the table.
     */
    protected array $items = [
        [
            'name' => 'Habbo Way',
            'content' => "Welcome to Habbo Hotel, where fun and excitement are always around the corner! 🎉 To ensure that everyone has the best experience possible, we've created The Habbo Way - our special set of rules that keeps our community safe and friendly. 🌈<br/><br/>It's important to know that these rules and regulations can change without notice. As a member of our awesome Habbo community, you agree to follow these terms and conditions. 😊 If you don't, there may be sanctions applied to your account.<br/><br/>But don't worry! If you have any questions or concerns about The Habbo Way, our friendly Hotel Staff are always here to help. 💬 Now, go ahead and click the button below to read The Habbo Way and join us in creating a fantastic environment for all! 🚀",
            'image_url' => 'safety_tips_1.png',
            'button_text' => 'Habbo Way',
            'button_url' => '/help-center/rules',
            'position' => 1,
        ],
        [
            'name' => 'Ban Appeals',
            'content' => "If you think you've been unfairly banned from our super cool hotel, no worries - we're here to help! 🌟 All you need to do is submit a ticket 🎟️ and let us know what happened.<br/><br/>We'll check it out and give you a fair chance to return to the awesome world of Habbo! 🕺💃 So go ahead, share your side of the story, and let's get you back in on the fun! 😄",
            'image_url' => 'safety_tips_5.png',
            'button_text' => 'Submit a ban appeal',
            'button_url' => '/help-center/tickets/create',
            'position' => 2,
        ],
        [
            'name' => 'VPN Unblock',
            'content' => "We know that sometimes you might need to use a VPN or proxy connection while visiting our fantastic hotel! 🏨 But since we want to keep our community safe and free from toxicity, we block these connections by default. 🛡️<br/><br/>However, we understand that there are exceptions, and we're here to help! 🌟 If you find yourself in one of these situations, you can request VPN unblocking:<br/><br/><div style='margin-left: 15px;'><strong>1.</strong> You're not using a VPN but still got flagged somehow. 🚩<br/><strong>2.</strong> You're at school or university and need a VPN to access Habbo. 🏫<br /><strong>3.</strong> You're on public connections that might be flagged as a VPN.</div> 📱<br/><br/>Please note that if using a VPN is optional for you, we usually deny the request. This is just to make sure we maintain a positive and friendly environment for all our users! 😄<br/><br/>To request VPN unblocking, simply submit a ticket with an explanation of your situation, and we'll do our best to help you out! Together, let's keep the Habbo Hotel experience amazing for everyone! 🎉",
            'image_url' => 'safety_tips_2.png',
            'button_text' => 'Submit Unblock request',
            'button_url' => '/help-center/tickets/create',
            'position' => 3,
        ],
        [
            'name' => 'Scam Reports',
            'content' => "Hey Habbo buddies! 🎉 We know that sometimes, unfortunately, users might try to scam others out of their coins, diamonds, or furniture. 😢 But don't worry, we've got your back! We don't tolerate this kind of behavior, and we're here to help you report it. 🌟<br/><br/>Have you been scammed? 😨<br/><br/>If so, we're here to assist! Just follow the template below and include it in a ticket under the 'Scam Reports' option:<br/><br/><div style='margin-left: 15px;'><strong>1.</strong> Scammed by:<br/><strong>2.</strong> Date of Scam:<br/><strong>3.</strong> Items Scammed:<br/><strong>4.</strong> Evidence (if available):</div><br/><br/>Remember, it's important to be honest and true to yourself! 🌈 Nobody likes a trickster, and stealing won't make you rich - it makes you a criminal. 😔 By reporting scams, we can work together to keep the Habbo Hotel a fun, safe, and amazing place for everyone! 🎊",
            'image_url' => 'safety_tips_7.png',
            'button_text' => 'Submit scam report',
            'position' => 4,
        ],
        [
            'name' => 'Room Ads',
            'content' => "Hey there, Habbo friends! 🌟 Did you know that you can make your room even cooler by displaying images in it? 😮 That's right! With room background furniture, you can embed images directly into your room on the hotel! 🖼️<br/><br/>However, by default, you won't have the furniture access or permission to do this. But no worries, you can apply for it! 🎉 All you need to do is submit a ticket and let us know why you'd like to have these awesome room ad rights. 📝<br/><br/>Once you've got the permission, you'll be able to customize your room and make it truly one-of-a-kind! 🌈 So go ahead and tell us why you need those rights, and let's take your room to the next level together! 🚀",
            'button_text' => 'Submit a ticket',
            'button_url' => '/help-center/tickets/create',
            'position' => 1,
            'small_box' => true,
        ],
        [
            'name' => 'Something else?',
            'content' => "We know that sometimes you might have questions, concerns, or just need a little help that doesn't fit into any specific category. No worries, we've got you covered! 🌟<br/><br/>For anything else that you need assistance with, simply select the 'Other' option when submitting a ticket. 📝<br/><br/>Our friendly and helpful Hotel Staff will be more than happy to get in touch and provide the support you need. 🤗 So go ahead, reach out to us for any reason, big or small, and let's make your Habbo experience the best it can be! 🚀",
            'button_text' => 'Submit a ticket',
            'button_url' => '/help-center/tickets/create',
            'position' => 2,
            'small_box' => true,
        ],
    ];

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('website_help_center_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->text('content');
            $table->unsignedInteger('position')->default(1);
            $table->string('image_url')->nullable();
            $table->string('button_text')->nullable();
            $table->string('button_url')->nullable();
            $table->string('button_color', 16)->default('#eeb425');
            $table->string('button_border_color', 16)->default('#facc15');
            $table->boolean('small_box')->default(false);
        });

        foreach ($this->items as $item) {
            DB::table('website_help_center_categories')->insert($item);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('website_help_center_categories');
    }
};
