# Run apt-get update to create the stamp file
execute "apt-get-update" do
  command "apt-get update"
  ignore_failure true
  not_if do ::File.exists?('/var/lib/apt/periodic/update-success-stamp') end
end

# For other recipes to call to force an update
execute "apt-get update" do
  command "apt-get update"
  ignore_failure true
  action :nothing
end

# provides /var/lib/apt/periodic/update-success-stamp on apt-get update
package "update-notifier-common" do
  notifies :run, resources(:execute => "apt-get-update"), :immediately
end

execute "apt-get-update-periodic" do
  command "apt-get update"
  ignore_failure true
  only_if do
    File.exists?('/var/lib/apt/periodic/update-success-stamp') &&
      File.mtime('/var/lib/apt/periodic/update-success-stamp') < Time.now - 86400
  end
end

package "python-software-properties"

execute "add php 5.4 repository" do
  not_if "grep ondrej /etc/apt/sources.list.d/*"
  command "add-apt-repository ppa:ondrej/php5"
end

# install the software we need
%w(
openjdk-6-jre-headless
curl
tmux
vim
git
libapache2-mod-php5
php5-cli
php5-curl
php5-intl
php5-dev
php-pear
).each { | pkg | package pkg }

template "/home/vagrant/.bash_aliases" do
  user "vagrant"
  mode "0644"
  source ".bash_aliases.erb"
end

file "/etc/apache2/sites-enabled/000-default" do
  action :delete
end

template "/etc/apache2/sites-enabled/vhost.conf" do
  user "root"
  mode "0644"
  source "vhost.conf.erb"
  notifies :reload, "service[apache2]"
end

execute "a2enmod rewrite"

service "apache2" do
  supports :restart => true, :reload => true, :status => true
  action [ :enable, :start ]
end

execute "date.timezone = UTC in php.ini?" do
 user "root"
 not_if "grep 'date.timezone = UTC' /etc/php5/cli/php.ini"
 command "echo -e '\ndate.timezone = UTC\n' >> /etc/php5/cli/php.ini"
end

template "/etc/apache2/sites-enabled/elasticsearch-head.conf" do
  user "root"
  mode "0644"
  source "elasticsearch-head.conf.erb"
  notifies :reload, "service[apache2]"
end

bash "install phpunit " do
  not_if "which phpunit"
  user "root"
  code <<-EOH
      pear channel-discover pear.phpunit.de
      pear channel-discover pear.symfony.com
      pear install --alldeps phpunit/PHPUnit
      EOH
end

execute "re-run composer to get the post-install things right" do
    user "vagrant"
    cwd "/vagrant"
    command "php composer.phar install --dev --prefer-source"
end
