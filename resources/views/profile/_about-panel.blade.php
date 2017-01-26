<div class="tabs-panel" id="about-panel">
  <table class="column row">
      <th class="text-left" colspan="2">About Me</th>
      <tr>
          <td>Name</td>
          <td>{{ $user->first_name }} {{ $user->middle_name }} {{ $user->last_name }}</td>
      </tr>
      @if($user->bio)
          <tr>
              <td>Bio</td>
              <td>{{ $user->bio }}</td>
          </tr>
      @endif
      @if($user->birthday)
          <tr>
              <td>Birthday</td>
              <td>{{ $user->birthday }}</td>
          </tr>
      @endif
      @if($user->ethnicity)
          <tr>
              <td>Ethnicity</td>
              <td>{{ $user->ethnicity }}</td>
          </tr>
      @endif
      <tr>
          <td>Gender</td>
          <td>{{ $user->gender }}</td>
      </tr>
      @if($user->interested_in)
          <tr>
              <td>Likes</td>
              <td>Women</td>
          </tr>
      @endif
      @if($user->civil_status)
          <tr>
              <td>Civil Status</td>
              <td>{{ $user->civil_status }}</td>
          </tr>
      @endif
      @if($user->living_in)
          <tr>
              <td>Living In</td>
              <td>{{ $user->living_in }}</td>
          </tr>
      @endif
  </table>
</div>
