<td class="header">
<a href="{{ $url }}" style="display: inline-block; text-decoration: none;">
<table role="presentation" style="margin: 0 auto; border-collapse: collapse;">
<tr>
    <td style="vertical-align: middle; padding-right: 10px;">
        <table role="presentation" style="width: 28px; border-collapse: collapse;">
        <tr>
            <td align="center" valign="middle"
                style="width: 28px; height: 28px; background-color: #005461; border-radius: 6px;">
            </td>
        </tr>
        </table>
    </td>
    <td style="vertical-align: middle;">
        <span style="color: #ffffff; font-size: 19px; font-weight: bold;">
            @if (trim($slot) === config('app.name'))
                {{ config('app.name') }}
            @else
                {{ $slot }}
            @endif
        </span>
    </td>
</tr>
</table>
</a>
</td>
</tr>