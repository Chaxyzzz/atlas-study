<?php
echo '<?xml version="1.0" encoding="UTF-8"?>';
?>
<Workbook xmlns="urn:schemas-microsoft-com:office:spreadsheet"
 xmlns:o="urn:schemas-microsoft-com:office:office"
 xmlns:x="urn:schemas-microsoft-com:office:excel"
 xmlns:ss="urn:schemas-microsoft-com:office:spreadsheet"
 xmlns:html="http://www.w3.org/TR/REC-html40">
 <Worksheet ss:Name="Users">
  <Table>
   <Row>
    <Cell><Data ss:Type="String">ID</Data></Cell>
    <Cell><Data ss:Type="String">Full Name</Data></Cell>
    <Cell><Data ss:Type="String">Username</Data></Cell>
    <Cell><Data ss:Type="String">Email</Data></Cell>
    <Cell><Data ss:Type="String">Phone</Data></Cell>
    <Cell><Data ss:Type="String">Provider</Data></Cell>
    <Cell><Data ss:Type="String">Role</Data></Cell>
    <Cell><Data ss:Type="String">Language</Data></Cell>
    <Cell><Data ss:Type="String">Status</Data></Cell>
    <Cell><Data ss:Type="String">Registration Date</Data></Cell>
    <Cell><Data ss:Type="String">Last Login</Data></Cell>
    <Cell><Data ss:Type="String">Last Login IP</Data></Cell>
    <Cell><Data ss:Type="String">Browser</Data></Cell>
    <Cell><Data ss:Type="String">Operating System</Data></Cell>
    <Cell><Data ss:Type="String">Device</Data></Cell>
   </Row>
   @foreach($users as $user)
   <Row>
    <Cell><Data ss:Type="Number">{{ $user->id }}</Data></Cell>
    <Cell><Data ss:Type="String">{{ $user->name }}</Data></Cell>
    <Cell><Data ss:Type="String">{{ $user->username ? '@' . ltrim($user->username, '@') : '' }}</Data></Cell>
    <Cell><Data ss:Type="String">{{ $user->email }}</Data></Cell>
    <Cell><Data ss:Type="String">{{ $user->phone ?: '' }}</Data></Cell>
    <Cell><Data ss:Type="String">{{ strtoupper($user->effective_provider) }}</Data></Cell>
    <Cell><Data ss:Type="String">{{ strtoupper($user->role ?: ($user->is_admin ? 'admin' : 'student')) }}</Data></Cell>
    <Cell><Data ss:Type="String">{{ strtoupper($user->preferred_language ?: 'id') }}</Data></Cell>
    <Cell><Data ss:Type="String">{{ strtoupper($user->status ?: 'active') }}</Data></Cell>
    <Cell><Data ss:Type="String">{{ $user->created_at ? $user->created_at->format('Y-m-d H:i:s') : '' }}</Data></Cell>
    <Cell><Data ss:Type="String">{{ $user->last_login_at ? $user->last_login_at->format('Y-m-d H:i:s') : '' }}</Data></Cell>
    <Cell><Data ss:Type="String">{{ $user->last_login_ip ?: '' }}</Data></Cell>
    <Cell><Data ss:Type="String">{{ $user->browser ?: '' }}</Data></Cell>
    <Cell><Data ss:Type="String">{{ $user->operating_system ?: '' }}</Data></Cell>
    <Cell><Data ss:Type="String">{{ $user->device ?: '' }}</Data></Cell>
   </Row>
   @endforeach
  </Table>
 </Worksheet>
</Workbook>
