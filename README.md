

## Drupal8 VM

Drupal VM makes building Drupal development environments quick and easy, and introduces developers to the wonderful world of Drupal development on virtual machines or Docker containers (instead of crufty old MAMP/WAMP-based development).

It will install the following on an Ubuntu 16.04 (by default) linux VM:

  - Drupal 8, with this modules:
    -
  - Apache 2.4.x (or Nginx)
  - PHP 7.1.x (configurable)
  - MySQL 5.7.x (or MariaDB, or PostgreSQL)
  - Drupal 7 or 8
  - Optional:
    - Drupal Console
    - Drush
    - Varnish 4.x (configurable)
    - Apache Solr 4.10.x (configurable)
    - Elasticsearch
    - Node.js 0.12 (configurable)
    - Selenium, for testing your sites via Behat
    - Ruby
    - Memcached
    - Redis
    - SQLite
    - Blackfire, XHProf, or Tideways for profiling your code
    - XDebug, for debugging your code
    - Adminer, for accessing databases directly
    - Pimp my Log, for easy viewing of log files
    - MailHog, for catching and debugging email

It should take 5-10 minutes to build or rebuild the VM from scratch on a decent broadband connection.


### Quick Start Guide

  1. Install [Vagrant](https://www.vagrantup.com/downloads.html) and [VirtualBox](https://www.virtualbox.org/wiki/Downloads).
  2. Download or clone this project to your workstation.
  3. `cd` into this project directory and run `vagrant up`.
  4. Extract and Import the database that is inside `db/d8_db.sql.gz` . I suggest to use the 'Adminer' tool, and import the file under: d8_db (MySql)


### 1 - Install Vagrant and VirtualBox

Download and install [Vagrant](https://www.vagrantup.com/downloads.html) and [VirtualBox](https://www.virtualbox.org/wiki/Downloads).

You can also use an alternative provider like Parallels or VMware. (Parallels Desktop 11+ requires the "Pro" or "Business" edition and the [Parallels Provider](http://parallels.github.io/vagrant-parallels/), and VMware requires the paid [Vagrant VMware integration plugin](http://www.vagrantup.com/vmware)).

Notes:

  - **For faster provisioning** (macOS/Linux only): *[Install Ansible](http://docs.ansible.com/intro_installation.html) on your host machine, so Drupal VM can run the provisioning steps locally instead of inside the VM.*
  - **For stability**: Because every version of VirtualBox introduces changes to networking, for the best stability, you should install Vagrant's `vbguest` plugin: `vagrant plugin install vagrant-vbguest`.
  - **NFS on Linux**: *If NFS is not already installed on your host, you will need to install it to use the default NFS synced folder configuration. See guides for [Debian/Ubuntu](https://www.digitalocean.com/community/tutorials/how-to-set-up-an-nfs-mount-on-ubuntu-14-04), [Arch](https://wiki.archlinux.org/index.php/NFS#Installation), and [RHEL/CentOS](https://www.digitalocean.com/community/tutorials/how-to-set-up-an-nfs-mount-on-centos-6).*
  - **Versions**: *Make sure you're running the latest releases of Vagrant, VirtualBox, and Ansible—as of late 2016, Drupal VM recommends: Vagrant 1.8.6, VirtualBox 5.1.10+, and Ansible 2.2.x*

### 3 - Access the VM.

Open your browser and access [http://drupalvm.dev/](http://drupalvm.dev/). The default login for the admin account is `admin` for both the username and password.

Note: *By default Drupal VM is configured to use `192.168.88.88` as its IP, if you're running multiple VM's the `auto_network` plugin (`vagrant plugin install vagrant-auto_network`) can help with IP address management if you set `vagrant_ip` to `0.0.0.0` inside `config.yml`.*

## Extra software/utilities

By default, this VM includes the extras listed in the `config.yml` option `installed_extras`:

    installed_extras:
      - adminer
      # - blackfire
      # - drupalconsole
      - drush
      # - elasticsearch
      # - java
      - mailhog
      # - memcached
      # - newrelic
      # - nodejs
      - pimpmylog
      # - redis
      # - ruby
      # - selenium
      # - solr
      # - tideways
      # - upload-progress
      - varnish
      # - xdebug
      # - xhprof

If you don't want or need one or more of these extras, just delete them or comment them from the list. This is helpful if you want to reduce PHP memory usage or otherwise conserve system resources.

### System Requirements

Drupal VM runs on almost any modern computer that can run VirtualBox and Vagrant, however for the best out-of-the-box experience, it's recommended you have a computer with at least:

  - Intel Core processor with VT-x enabled
  - At least 4 GB RAM (higher is better)
  - An SSD (for greater speed with synced folders)

### Other Notes

  - To shut down the virtual machine, enter `vagrant halt` in the Terminal in the same folder that has the `Vagrantfile`. To destroy it completely (if you want to save a little disk space, or want to rebuild it from scratch with `vagrant up` again), type in `vagrant destroy`.
  - To log into the virtual machine, enter `vagrant ssh`. You can also get the machine's SSH connection details with `vagrant ssh-config`.
  - When you rebuild the VM (e.g. `vagrant destroy` and then another `vagrant up`), make sure you clear out the contents of the `drupal` folder on your host machine, or Drupal will return some errors when the VM is rebuilt (it won't reinstall Drupal cleanly).
  - You can change the installed version of Drupal or drush, or any other configuration options, by editing the variables within `config.yml`.
  - Find out more about local development with Vagrant + VirtualBox + Ansible in this presentation: [Local Development Environments - Vagrant, VirtualBox and Ansible](http://www.slideshare.net/geerlingguy/local-development-on-virtual-machines-vagrant-virtualbox-and-ansible).
  - Learn about how Ansible can accelerate your ability to innovate and manage your infrastructure by reading [Ansible for DevOps](http://www.ansiblefordevops.com/).


## License

This project is licensed under the MIT open source license.


Thanks so much to [Jeff Geerling](https://www.jeffgeerling.com/) the creator of the VM, I just add a Drupal 8 setup, with cool modules to start a project development.

More info from the DrupalVM: http://docs.drupalvm.com/

