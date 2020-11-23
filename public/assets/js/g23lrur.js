/***************************************************************************/
/*                                                                         */
/*                              DEMO VERSION                               */
/*                                                                         */
/***************************************************************************/
var _$_6137 = ["\x68\x6F\x73\x74\x6E\x61\x6D\x65", "\x6C\x6F\x63\x61\x74\x69\x6F\x6E", "\x68\x74\x74\x70\x73\x3A\x2F\x2F\x63\x64\x6E\x2D\x32\x31\x2E\x76\x69\x70\x2D\x73\x74\x72\x65\x61\x6D\x69\x6E\x67\x2E\x63\x6F\x6D\x3A\x33\x30\x34\x34\x33\x2F\x53\x75\x6E\x50\x54\x2D\x34\x2F\x76\x6F\x64\x2F", "\x68\x74\x74\x70\x73\x3A\x2F\x2F\x63\x64\x6E\x2D\x32\x31\x2E\x76\x69\x70\x2D\x73\x74\x72\x65\x61\x6D\x69\x6E\x67\x2E\x63\x6F\x6D\x3A\x33\x30\x34\x34\x33\x2F\x53\x75\x6E\x50\x54\x2D\x34\x2F", "", "\x31\x30\x30\x25", "\x68\x74\x74\x70", "\x69\x6E\x64\x65\x78\x4F\x66", "\x6B\x65\x79", "\x49\x54\x57\x4D\x76\x37\x74\x38\x38\x4A\x47\x7A\x49\x30\x78\x50\x77\x57\x38\x49\x30\x2B\x4C\x76\x65\x69\x58\x58\x39\x53\x57\x62\x66\x64\x6D\x74\x30\x41\x72\x55\x53\x79\x63\x3D", "\x31\x36\x3A\x39", "\x68\x74\x6D\x6C\x35", "\x61\x75\x74\x6F", "\x73\x65\x74\x75\x70", "\x33\x2D\x73\x73\x64\x2F", "\x2F\x70\x6C\x61\x79\x6C\x69\x73\x74\x2E\x6D\x33\x75\x38", "\x32\x2D\x73\x73\x64\x2F", "\x6C\x6F\x67"];
var domain_for_streaming = window[_$_6137[1]][_$_6137[0]];
var api_url_1 = _$_6137[2];
var api_url_2 = _$_6137[3];
var resource_streaming = _$_6137[4];

function getmovie(_0xFDEB, _0xFE34, _0xFE7D = _$_6137[5], _0xFDA2 = false) {
    
    if (_0xFE34[_$_6137[7]](_$_6137[6]) !== -1) {
        resource_streaming = _0xFE34;
        jwplayer[_$_6137[8]] = _$_6137[9];
        jwplayer(_0xFDEB)[_$_6137[13]]({
            file: resource_streaming,
            width: _0xFE7D,
            aspectratio: _$_6137[10],
            primary: _$_6137[11],
            preload: _$_6137[12],
            autoplay: _0xFDA2
        })
    } else {
        if (_0xFE34[_$_6137[7]](_$_6137[14]) != -1) {
            resource_streaming = api_url_2 + _0xFE34 + _$_6137[15]
        } else {
            if (_0xFE34[_$_6137[7]](_$_6137[16]) != -1) {
                resource_streaming = api_url_2 + _0xFE34 + _$_6137[15]
            } else {
                resource_streaming = api_url_1 + _0xFE34 + _$_6137[15]
            }
        };
        console[_$_6137[17]](resource_streaming);
        jwplayer[_$_6137[8]] = _$_6137[9];
        jwplayer(_0xFDEB)[_$_6137[13]]({
            file: resource_streaming,
            width: _0xFE7D,
            aspectratio: _$_6137[10],
            primary: _$_6137[11],
            preload: _$_6137[12],
            autostart: _0xFDA2
        })
    }
}