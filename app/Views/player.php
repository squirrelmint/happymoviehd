<html>
<head>
    <meta charset="utf-8" />
    <script src="<?php echo $document_root ?>/assets/js/jwplayer.js"></script>
    <script src="<?php echo $document_root ?>/assets/js/g23lrur.js"></script>
    <script src="https://cdn.jwplayer.com/libraries/rYlCdkEJ.js"></script>
    <link rel="stylesheet" href='<?php echo $document_root ?>/assets/css/player.css?v=1'>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>

<body class="if-size">
    <div id="playervideo" style="display: none;">Movie Player</div>

    
    <?php

        $ads_video = $adsvideo;

    	if( !empty($ads_video) ){
	    	foreach ($ads_video as $key => $value) {
	        $hidden = "";

	        if ($key != 0) {
	            $hidden .= "style = 'display:none;'";
	        }
    ?>

        <div id="ads<?= $key ?>" style="z-index:1000;">
            <div id="adsplayer<?= $key ?>" <?= $hidden ?>>This ads player <?= $key ?> </div>

            <?php if ($key == 0) { ?>

                <script>
                    jwplayer('adsplayer<?= $key ?>').setup({
                        autostart: false,
                        width: '100%',
                        height: '100%',
                        controls: true,
                        file: "<?= $value['file'] ?>"
                    });
                </script>

            <?php } ?>



            <div id="adsclick<?= $key ?>" style="display: none;"></div>

            <div class="registerads" id="registerads<?= $key ?>" style="display: none;z-index: 1000;">
                <a onclick="onClickAds(<?= $value['adsvideo_id'] ?>, <?= $branch ?>)" href="<?= $value['url'] ?>" target="_blank"><span id="register<?= $key ?>">สมัครสมาชิก</span></a>
            </div>

            <div class="skipads" id="skipads<?= $key ?>" style="display: none;">
                <span id="timeer<?= $key ?>">กรุณารอ 5 วิ</span>
            </div>

        </div>

    <?php 
			} 
		}
    ?>



    <script>

        $(document).ready(function() {

        	<?php if ( !empty($ads_video) ) { ?>
	            <?php foreach ($ads_video as $key => $value) { ?>

	                $("#adsclick<?= $key ?>").click(function() {
	                    window.open("<?= $value['url'] ?>", '_blank');
	                });

	            <?php } ?>

	            setAdsFrist();

	        <?php }else{ ?>

	            setMovie();
	            $('#playervideo').show();

	        <?php } ?>

        });

        function setMovie() {
            getmovie("playervideo", "<?= $playerUrl ?>", "100%", false);
        } 

        function setAdsFrist() {

            jwplayer("adsplayer0").on('complete', function() {

                $('#ads0').hide();
                <?php if (count($ads_video) > 1) { ?>
                    setAds1();
                <?php } else { ?>
					setMovie();
                    $('#playervideo').show();
                <?php } ?>

            });

            jwplayer("adsplayer0").on('error', function() {
                <?php if (count($ads_video) > 1) { ?>

                    $('#ads0').hide();
                    $('#skipads0').hide();
                    $('#registerads0').hide();
                    setAds1();
                    $('#adsplayer1').show();

                <?php } else { ?>

                    $('#ads0').hide();
                    $('#skipads0').hide();
                    $('#registerads0').hide();
                    setMovie();
                    $('#playervideo').show();

                <?php } ?>

            });

            jwplayer("adsplayer0").on('play', function() {

                $('#adsclick0').show();
                $('#skipads0').show();
                $('#registerads0').show();

                var timeleft = 5; // กรุณารอ
                var downloadTimer = setInterval(function() {
                    timeleft--;
                    $("#timeer0").text('กรุณารอ ' + timeleft + ' วิ');

                    if (timeleft <= 0) {
                        $("#timeer0").text('กดข้ามโฆษณา');
                        $('#skipads0').click(function() {

                            <?php if (count($ads_video) > 1) { ?>

                                $('#ads0').hide();
                                $('#skipads0').hide();
                                jwplayer("adsplayer0").remove();
                                setAds1();
                                $('#adsplayer1').show();
                                $('#adsplayer1').load();

                            <?php } else { ?>

                                $('#ads0').hide();
                                $('#skipads0').hide();
                                jwplayer("adsplayer0").remove();
                                setMovie();
                                $('#playervideo').show();
                                $('#playervideo').load();

                            <?php } ?>

                        });
                    }
                }, 1000);
            });
        }

        function onClickAds(adsid, branch) {
            var backurl = '<?php echo $backUrl; ?>';
            $.ajax({
                url: backurl + "adsvdo/sid/<?= session_id() ?>/adsid/" + adsid + "/branch/" + branch,
                async: true,
                success: function(response) {
                    console.log(response); // server response
                }
            });
        }

        <?php for ($i = 1; $i < count($ads_video); $i++) {

            $value = $ads_video[$i];
            $key = $i; ?>

            <?php if ($key > 0 && $key != (count($ads_video) - 1)) {

                $auto = "true"; ?>
                function setAds<?= $key ?>() {

                    jwplayer("adsplayer<?= $key ?>").setup({
                        "autostart": '<?= $auto ?>'
                        "file": "<?= $value['file'] ?>",
                        "height": '100%',
                        "width": "100%",
                        "aspectratio": "16:9",
                        "androidhls": true,
                        "preload": "auto",
                        "hlshtml": true,
                        "stretching": "uniform",
                        "controls": false,
                        "playbackRateControls": true,
                        "primary": "html5"
                    });

                    jwplayer("adsplayer<?= $key ?>").on('complete', function() {

                        $('#ads<?= $key ?>').hide();
                        setAds<?= $key + 1 ?>();

                    });

                    jwplayer("adsplayer<?= $key ?>").on('error', function() {
                        $('#ads<?= $key ?>').hide();
                        $('#skipads<?= $key ?>').hide();
                        $('#registerads<?= $key ?>').hide();
                        setAds<?= $key + 1 ?>();
                        $('#adsplayer<?= $key + 1 ?>').show();
                        $('#adsplayer<?= $key + 1 ?>').load();
                    });

                    jwplayer("adsplayer<?= $key ?>").on('play', function() {

                        $('#adsclick<?= $key ?>').show();
                        $('#skipads<?= $key ?>').show();
                        $('#registerads<?= $key ?>').show();

                        var timeleft = 5; // กรุณารอ
                        var downloadTimer = setInterval(function() {
                            timeleft--;
                            $("#timeer<?= $key ?>").text('กรุณารอ ' + timeleft + ' วิ');

                            if (timeleft <= 0) {
                                $("#timeer<?= $key ?>").text('กดข้ามโฆษณา');
                                $('#skipads<?= $key ?>').click(function() {

                                    $('#ads<?= $key ?>').hide();
                                    $('#skipads<?= $key ?>').hide();
                                    jwplayer("adsplayer<?= $key ?>").remove();
                                    setAds<?= $key + 1 ?>();
                                    $('#adsplayer<?= $key + 1 ?>').show();
                                    $('#adsplayer<?= $key + 1 ?>').load();

                                });
                            }
                        }, 1000);
                    });
                }

            <?php } else if ($key == (count($ads_video) - 1)) { ?>

                function setAds<?= $key ?>() {

                    jwplayer("adsplayer<?= $key ?>").setup({
                        "autostart": 'true',
                        "file": "<?= $value['file'] ?>",
                        "height": '100%',
                        "width": "100%",
                        "aspectratio": "16:9",
                        "androidhls": true,
                        "preload": "auto",
                        "hlshtml": true,
                        "stretching": "uniform",
                        "controls": false,
                        "playbackRateControls": true,
                        "primary": "html5"
                    });

                    jwplayer("adsplayer<?= $key ?>").on('complete', function() {

                        $('#ads<?= $key ?>').hide();
                        setMovie();
                        $('#playervideo').show();

                    });

                    jwplayer("adsplayer<?= $key ?>").on('error', function() {

                        $('#ads<?= $key ?>').hide();
                        $('#skipads<?= $key ?>').hide();
                        $('#registerads<?= $key ?>').hide();
                        setMovie();
                        $('#playervideo').show();
                        $('#playervideo').load();

                    });

                    jwplayer("adsplayer<?= $key ?>").on('play', function() {

                        $('#adsclick<?= $key ?>').show();
                        $('#skipads<?= $key ?>').show();
                        $('#registerads<?= $key ?>').show();

                        var timeleft = 5; // กรุณารอ
                        var downloadTimer = setInterval(function() {
                            timeleft--;
                            $("#timeer<?= $key ?>").text('กรุณารอ ' + timeleft + ' วิ');

                            if (timeleft <= 0) {

                                $("#timeer<?= $key ?>").text('กดข้ามโฆษณา');
                                $('#skipads<?= $key ?>').click(function() {

                                    $('#ads<?= $key ?>').hide();
                                    $('#skipads<?= $key ?>').hide();
                                    jwplayer("adsplayer<?= $key ?>").remove();
                                    setMovie();
                                    $('#playervideo').show();
                                    $('#playervideo').load();

                                });

                            }
                        }, 1000);
                    });
                }

            <?php } ?>
        <?php } ?>

    </script>

</body>
</html>