<?

# Tor & Proxy Detection/Logging Script.

# Get Remote IP
$locIP = $_SERVER['REMOTE_ADDR'];

# Array with 1000+ Tor exit nodes
$nodes = array("1.50.130.66","1.106.108.74","8.7.49.192","12.30.222.65","12.47.45.30","12.76.134.80","12.199.41.18","12.216.43.40","18.42.0.124","18.78.1.92","18.152.2.242","18.187.1.68","18.243.0.74","18.243.2.53","18.244.0.114","18.244.0.188","18.244.3.24","18.246.1.160","18.246.2.33","18.246.7.53","24.4.89.16","24.5.75.64","24.6.113.157","24.9.112.83","24.13.251.90","24.18.219.157","24.21.174.42","24.21.201.6","24.26.255.115","24.29.193.226","24.34.216.164","24.37.240.245","24.46.205.89","24.77.19.105","24.79.66.252","24.80.166.229","24.110.70.10","24.128.81.24","24.136.24.119","24.168.217.245","24.172.9.74","24.182.226.192","24.196.147.65","24.202.5.70","24.208.61.65","24.208.96.160","24.211.109.148","24.214.158.127","24.224.182.114","24.254.46.92","27.241.149.238","35.8.221.199","35.10.112.176","58.25.15.17","58.80.151.210","58.98.102.6","58.107.243.194","58.246.251.228","59.78.26.83","59.78.51.43","59.81.208.2","59.95.23.39","59.117.61.3","59.134.15.153","59.167.54.55","60.3.49.4","61.24.152.119","61.48.40.246","61.124.59.176","61.145.142.112","61.175.174.158","62.1.111.186","62.2.85.158","62.8.76.134","62.48.34.110","62.48.42.77","62.58.61.172","62.75.138.155","62.75.139.197","62.75.163.23","62.75.170.214","62.75.171.154","62.75.171.213","62.75.186.127","62.75.202.231","62.75.220.75","62.75.223.163","62.75.224.53","62.75.252.130","62.112.159.61","62.128.27.167","62.136.140.179","62.141.56.164","62.142.248.53","62.143.65.37","62.143.213.250","62.149.12.179","62.163.50.235","62.163.136.55","62.166.240.67","62.197.40.155","62.208.181.42","62.214.247.138","62.219.46.202","62.220.137.73","62.241.240.86","62.245.208.245","62.245.233.242","63.85.194.6","63.88.72.140","63.228.65.81","64.5.53.220","64.5.53.254","64.20.233.234","64.22.71.125","64.26.169.184","64.27.20.188","64.27.25.205","64.34.163.38","64.62.231.86","64.69.39.175","64.81.59.235","64.81.87.116","64.81.90.94","64.81.160.72","64.81.245.86","64.95.64.86","64.115.210.23","64.122.12.107","64.136.200.11","64.142.31.83","64.142.98.231","64.146.134.221","64.151.99.196","64.158.128.204","64.164.59.200","64.223.185.68","64.230.43.188","64.234.48.179","65.11.183.176","65.19.133.131","65.19.178.92","65.27.17.90","65.27.93.149","65.80.61.42","65.92.97.104","65.99.219.91","65.110.239.132","65.111.168.165","65.189.34.237","65.189.179.203","65.190.195.78","65.196.226.32","66.23.214.241","66.31.235.23","66.44.252.161","66.68.89.160","66.70.10.53","66.75.44.219","66.90.89.162","66.92.13.212","66.92.65.81","66.92.128.186","66.92.216.74","66.93.170.242","66.98.136.49","66.98.208.43","66.111.43.137","66.114.65.225","66.116.103.156","66.117.13.120","66.134.212.156","66.135.40.74","66.150.225.130","66.161.188.33","66.183.197.79","66.188.138.4","66.199.115.161","66.199.184.254","66.199.236.130","66.199.236.138","66.199.240.50","66.199.252.58","66.219.59.183","66.219.161.166","66.223.212.213","66.228.127.27","66.241.84.227","66.254.102.58","67.15.225.36","67.18.92.141","67.18.176.246","67.32.211.213","67.36.181.12","67.43.74.54","67.43.175.98","67.53.237.73","67.80.106.153","67.81.126.205","67.81.235.115","67.82.220.107","67.86.62.52","67.88.160.77","67.101.88.127","67.102.35.23","67.119.62.34","67.125.20.68","67.140.146.46","67.150.246.152","67.160.250.130","67.161.16.53","67.161.84.81","67.168.54.94","67.169.209.130","67.173.230.103","67.189.177.251","67.190.122.2","68.1.171.108","68.2.126.115","68.5.113.81","68.9.55.182","68.34.32.200","68.38.186.25","68.40.180.248","68.41.184.140","68.41.240.217","68.42.51.37","68.42.176.212","68.45.64.134","68.45.134.201","68.48.64.78","68.52.89.97","68.55.61.166","68.61.232.202","68.62.77.70","68.63.98.46","68.84.169.147","68.92.233.76","68.94.20.215","68.98.53.14","68.98.151.74","68.100.145.233","68.101.165.227","68.101.176.88","68.107.40.142","68.108.88.83","68.113.73.79","68.117.130.197","68.118.5.78","68.146.236.11","68.178.205.201","68.183.231.16","68.205.8.81","68.225.194.136","68.229.100.134","68.230.66.119","68.231.18.38","69.12.145.165","69.12.150.55","69.12.180.247","69.13.8.97","69.20.97.236","69.30.67.184","69.31.42.139","69.31.215.175","69.41.174.196","69.57.148.142","69.71.171.12","69.92.114.110","69.93.127.87","69.111.193.235","69.113.27.92","69.118.22.237","69.123.9.119","69.132.182.220","69.154.30.107","69.180.189.186","69.227.50.68","69.230.8.156","69.230.48.208","69.234.190.170","69.251.182.82","70.39.76.189","70.51.48.207","70.58.216.22","70.62.108.5","70.68.199.186","70.85.16.127","70.87.68.18","70.91.96.246","70.101.164.134","70.110.70.238","70.126.43.33","70.150.81.247","70.162.109.122","70.176.90.98","70.181.251.175","70.188.190.20","70.190.182.173","70.217.87.25","70.225.173.221","70.238.168.39","70.249.187.222","71.35.13.100","71.56.235.157","71.58.155.8","71.59.64.240","71.63.21.101","71.83.124.90","71.111.248.108","71.112.33.151","71.112.132.254","71.116.107.186","71.135.186.162","71.135.237.200","71.146.78.242","71.149.171.169","71.159.132.77","71.161.67.224","71.162.144.139","71.196.199.10","71.196.232.177","71.204.191.190","71.210.160.43","71.213.246.25","71.222.54.43","71.222.221.207","71.230.172.208","71.233.40.61","71.240.66.224","71.245.108.218","71.251.177.92","71.254.5.150","72.5.28.193","72.9.108.50","72.21.43.18","72.22.74.160","72.29.105.147","72.36.239.30","72.53.30.174","72.74.232.118","72.81.214.126","72.84.34.110","72.84.236.48","72.91.4.131","72.94.35.48","72.128.43.18","72.148.54.247","72.165.205.81","72.199.231.92","72.225.234.118","72.226.235.52","74.0.33.114","74.67.39.22","74.98.65.109","74.100.7.19","74.101.209.195","74.107.218.103","74.111.76.178","74.120.203.162","74.131.221.228","74.228.43.157","74.229.201.181","74.245.147.242","75.7.20.73","75.14.47.216","75.18.166.44","75.24.210.240","75.26.199.90","75.35.114.142","75.49.220.231","75.55.112.14","75.73.50.24","75.75.111.243","75.80.103.27","75.118.10.85","75.126.84.56","75.126.145.251","75.136.131.154","75.199.10.183","76.105.128.69","76.173.92.244","76.177.51.154","76.178.207.109","76.212.72.209","77.160.175.107","77.181.195.178","80.54.76.182","80.56.237.114","80.68.85.45","80.68.88.204","80.68.93.199","80.74.143.186","80.97.189.111","80.108.1.149","80.126.37.100","80.132.21.20","80.138.202.65","80.142.123.59","80.144.114.154","80.144.144.21","80.168.226.105","80.171.18.41","80.176.127.11","80.190.240.59","80.190.241.118","80.190.242.122","80.190.243.158","80.190.250.108","80.192.83.225","80.203.229.249","80.213.54.145","80.218.101.73","80.219.32.212","80.219.250.158","80.222.65.173","80.223.106.128","80.237.146.62","80.237.173.67","80.237.200.9","80.237.235.9","80.242.195.68","80.248.254.68","80.253.14.102","81.0.225.29","81.5.172.97","81.25.83.89","81.36.81.218","81.50.219.211","81.56.100.148","81.56.140.248","81.57.208.135","81.89.5.229","81.101.138.168","81.169.136.161","81.169.137.115","81.169.137.209","81.169.155.246","81.169.156.7","81.169.156.213","81.169.158.102","81.169.166.136","81.169.168.22","81.169.168.142","81.169.171.90","81.169.173.134","81.169.174.124","81.169.183.77","81.169.183.122","81.173.254.122","81.216.158.19","81.219.161.148","81.227.231.218","81.230.38.145","82.6.104.255","82.23.235.232","82.32.74.162","82.33.45.32","82.44.77.89","82.57.67.49","82.60.166.253","82.66.131.125","82.67.91.66","82.69.174.251","82.71.67.89","82.77.215.74","82.81.143.92","82.81.210.191","82.82.64.21","82.83.100.163","82.83.254.69","82.84.93.67","82.92.197.115","82.93.130.253","82.93.181.15","82.94.251.206","82.95.239.45","82.99.228.231","82.100.252.138","82.103.138.222","82.105.138.101","82.113.63.70","82.118.210.65","82.141.90.214","82.149.72.85","82.156.33.125","82.158.148.139","82.160.236.72","82.165.144.169","82.165.180.112","82.165.184.7","82.182.15.84","82.182.59.155","82.182.109.115","82.197.230.23","82.212.19.166","82.214.2.226","82.220.2.75","82.226.49.76","82.226.84.53","82.227.12.18","82.227.61.106","82.229.114.49","82.229.209.107","82.230.27.226","82.231.59.44","82.233.90.183","82.233.236.81","82.234.27.188","82.234.133.30","82.240.72.48","82.240.206.88","82.241.0.123","82.241.115.49","82.245.214.104","82.247.153.205","82.249.111.175","82.252.189.58","82.253.49.106","83.16.228.227","83.19.22.173","83.26.43.120","83.28.63.129","83.29.254.105","83.36.224.169","83.64.118.186","83.64.208.20","83.65.91.108","83.70.200.103","83.73.148.230","83.83.157.25","83.85.58.155","83.103.25.45","83.108.101.131","83.125.32.209","83.125.40.111","83.133.125.189","83.134.144.230","83.137.98.49","83.149.231.208","83.151.30.211","83.160.255.58","83.167.111.136","83.171.145.86","83.171.160.38","83.171.175.18","83.171.179.202","83.171.184.24","83.216.204.134","83.219.212.101","83.228.204.40","83.235.62.180","83.240.24.205","83.245.15.87","83.246.72.228","83.246.94.31","83.252.194.243","83.254.150.242","84.4.246.88","84.10.224.215","84.16.233.47","84.16.234.49","84.16.235.143","84.16.236.173","84.16.238.86","84.16.238.147","84.19.177.90","84.19.182.23","84.20.244.105","84.38.64.20","84.38.64.155","84.40.199.218","84.41.143.100","84.41.177.144","84.44.226.228","84.55.112.80","84.56.8.254","84.56.188.188","84.56.246.127","84.57.66.124","84.58.138.172","84.58.142.224","84.60.9.18","84.60.166.69","84.72.2.167","84.73.121.250","84.73.183.239","84.74.129.195","84.75.61.187","84.75.97.223","84.75.246.166","84.85.160.44","84.86.210.63","84.102.190.11","84.113.153.195","84.113.155.16","84.114.182.93","84.131.141.160","84.134.101.126","84.141.69.48","84.141.189.133","84.142.145.227","84.143.72.225","84.144.147.190","84.147.255.17","84.157.158.232","84.159.65.59","84.160.61.56","84.162.91.178","84.166.172.144","84.167.209.52","84.171.222.71","84.172.182.157","84.173.111.26","84.177.42.137","84.179.12.40","84.179.214.75","84.180.48.52","84.189.184.18","84.220.103.234","84.220.115.241","84.220.138.73","84.223.80.164","84.252.0.154","84.255.203.220","85.8.136.101","85.10.198.236","85.10.200.47","85.10.205.45","85.10.210.86","85.10.227.182","85.14.216.5","85.14.217.83","85.14.217.228","85.14.220.126","85.17.11.70","85.18.107.240","85.25.5.64","85.25.20.175","85.25.47.46","85.25.62.36","85.25.66.207","85.25.132.119","85.25.135.167","85.25.136.135","85.25.138.205","85.25.138.220","85.25.141.60","85.25.141.145","85.25.144.94","85.25.146.77","85.25.253.104","85.31.187.84","85.31.187.90","85.73.133.198","85.88.6.170","85.116.205.238","85.119.156.72","85.119.158.191","85.134.13.172","85.140.204.94","85.141.120.133","85.145.184.81","85.154.44.241","85.176.74.237","85.176.83.151","85.176.92.59","85.176.190.9","85.177.148.169","85.177.174.157","85.177.234.222","85.177.237.252","85.177.242.11","85.178.37.229","85.178.67.224","85.178.88.105","85.178.98.135","85.179.11.67","85.179.20.138","85.179.99.119","85.179.201.104","85.180.59.212","85.180.74.159","85.180.113.174","85.181.90.60","85.185.228.93","85.186.13.252","85.187.152.189","85.192.53.5","85.193.8.34","85.210.227.170","85.214.17.144","85.214.18.16","85.214.19.110","85.214.24.183","85.214.26.150","85.214.27.102","85.214.29.9","85.214.29.10","85.214.29.33","85.214.29.92","85.214.36.108","85.214.38.21","85.214.44.126","85.214.50.115","85.214.54.254","85.214.57.226","85.214.63.253","85.214.66.10","85.214.66.61","85.214.68.60","85.214.68.105","85.214.73.63","85.214.78.217","85.214.83.203","85.214.85.116","85.214.86.4","85.214.90.235","85.214.91.152","85.214.92.55","85.214.94.149","85.216.50.176","85.221.156.121","85.221.173.161","85.225.12.160","85.225.171.211","85.225.224.216","85.227.214.248","85.227.240.184","85.228.118.218","85.228.176.123","85.228.237.47","85.234.130.43","85.235.31.133","86.10.72.242","86.13.247.182","86.15.239.219","86.56.26.161","86.59.21.38","86.68.190.224","86.126.238.105","87.0.35.28","87.1.59.247","87.5.147.131","87.5.157.252","87.6.39.109","87.7.200.219","87.8.66.152","87.11.5.82","87.11.7.199","87.15.209.27","87.15.233.237","87.52.36.142","87.94.87.164","87.101.17.16","87.105.74.181","87.106.9.89","87.106.20.213","87.106.27.17","87.106.34.45","87.106.77.37","87.118.110.163","87.118.110.180","87.122.14.220","87.139.38.91","87.165.211.110","87.175.106.160","87.175.194.121","87.178.107.193","87.186.13.81","87.187.124.68","87.194.33.196","87.194.61.194","87.216.187.46","87.217.59.240","87.226.57.34","87.228.35.82","87.230.9.166","87.230.11.82","87.230.11.166","87.230.17.81","87.230.18.23","87.230.18.148","87.234.91.238","87.234.94.254","87.246.52.14","88.42.221.180","88.64.156.46","88.65.13.239","88.66.58.213","88.72.233.151","88.73.2.253","88.73.10.96","88.73.82.39","88.73.127.209","88.76.201.49","88.80.12.78","88.84.139.250","88.84.144.63","88.84.150.178","88.85.140.147","88.114.239.165","88.115.79.224","88.115.106.10","88.115.125.144","88.134.42.101","88.134.80.186","88.149.233.156","88.162.149.207","88.168.4.99","88.191.12.12","88.191.13.68","88.191.16.100","88.191.24.59","88.191.24.77","88.191.47.162","88.191.51.214","88.192.111.39","88.193.24.152","88.196.18.119","88.198.9.16","88.198.11.5","88.198.17.116","88.198.37.146","88.198.43.103","88.198.45.235","88.198.47.72","88.198.50.146","88.198.59.34","88.198.90.110","88.198.95.67","88.198.96.154","88.198.109.123","88.198.127.245","88.198.133.83","88.198.148.74","88.198.160.123","88.198.164.126","88.198.169.99","88.198.175.78","88.198.180.62","88.198.192.154","88.198.206.70","88.198.252.126","88.208.203.85","88.211.140.199","88.217.199.43","89.7.11.107","89.12.142.155","89.14.83.18","89.15.36.241","89.21.78.73","89.38.160.66","89.48.18.101","89.49.138.248","89.49.245.88","89.54.145.24","89.56.155.114","89.56.173.140","89.60.170.218","89.85.250.194","89.110.4.135","89.110.147.209","89.110.149.90","89.110.156.179","89.110.156.203","89.110.157.31","89.136.36.165","89.145.19.143","89.148.139.2","89.149.194.143","89.149.205.56","89.149.206.52","89.149.207.172","89.149.208.121","89.150.202.174","89.150.203.69","89.152.128.37","89.163.1.20","89.163.145.20","89.178.0.250","89.182.20.241","89.245.103.160","89.247.5.219","90.24.113.53","90.29.111.218","90.195.225.37","90.196.51.217","91.0.84.218","91.0.234.217","91.4.85.161","91.23.239.248","91.64.55.133","91.64.201.30","91.84.22.17","91.126.55.23","91.152.83.113","100.0.2.29","100.0.2.236","122.48.104.108","124.72.8.16","124.237.252.236","124.254.11.2","125.24.217.122","125.33.151.29","125.63.241.233","128.2.141.33","128.2.164.68","128.83.114.63","128.138.207.48","128.197.11.30","128.232.110.15","129.2.159.207","129.21.136.157","129.21.136.230","129.21.147.187","129.21.148.2","129.93.140.190","129.187.150.131","129.241.146.124","130.89.160.179","130.89.161.226","130.89.168.17","130.89.224.42","130.94.161.18","130.126.141.153","130.234.193.5","131.114.79.140","131.155.71.110","131.155.141.98","131.215.220.1","134.53.24.52","134.93.142.48","134.93.142.188","134.130.57.18","134.130.58.104","134.161.241.106","136.159.122.108","137.120.180.89","137.193.216.89","137.226.13.2","137.226.181.149","138.23.10.43","138.26.117.12","138.202.192.210","139.14.2.99","139.142.227.9","140.115.218.81","140.115.221.182","140.116.198.64","140.121.136.186","140.124.7.56","140.247.60.64","141.22.37.180","141.149.128.197","143.89.220.238","145.18.230.38","145.253.97.246","146.201.211.64","148.88.224.185","149.9.0.27","149.9.0.56","149.9.0.57","149.9.0.58","149.9.0.59","150.140.191.108","150.189.0.254","150.214.190.58","151.42.191.60","152.13.233.17","154.20.18.254","154.20.37.201","156.17.2.222","156.17.236.205","157.252.161.61","158.136.172.134","161.53.160.104","163.13.112.191","166.70.207.2","166.111.249.39","168.103.68.113","168.150.251.39","171.64.40.65","172.143.60.37","172.147.126.206","172.173.204.66","190.49.78.51","190.49.193.45","190.83.29.166","192.35.100.7","192.35.156.110","192.42.113.248","192.67.63.148","192.83.249.30","192.108.114.19","193.10.222.246","193.37.152.63","193.40.2.229","193.55.112.121","193.193.75.236","193.196.182.215","193.202.88.3","193.219.28.245","193.219.115.200","193.224.70.6","193.239.206.80","194.12.245.110","194.21.56.6","194.109.206.212","194.150.121.10","194.152.123.48","194.171.167.147","194.177.96.78","194.231.188.66","195.5.26.156","195.14.201.48","195.37.132.28","195.71.8.10","195.85.225.145","195.90.9.250","195.97.194.77","195.111.98.214","195.158.167.214","195.169.205.25","195.177.250.222","195.210.38.204","195.230.168.95","195.244.97.205","198.110.198.26","198.144.213.28","198.145.242.242","198.145.252.45","199.77.130.14","199.107.161.10","200.84.222.34","200.121.55.151","201.17.210.205","201.29.135.71","201.92.84.139","201.231.29.91","201.231.93.247","202.8.232.251","202.44.12.79","202.113.118.250","202.131.32.165","202.156.176.30","202.224.114.27","203.59.207.185","203.64.180.33","203.118.218.124","203.125.99.85","204.11.35.133","204.13.236.244","204.14.158.71","204.15.133.171","204.15.208.64","204.253.162.11","205.244.242.67","206.13.125.181","206.51.237.8","206.63.200.41","206.123.107.119","206.174.19.25","206.222.29.14","206.231.255.250","207.7.145.213","207.36.232.16","207.44.180.3","207.150.167.67","207.164.80.29","207.210.101.242","207.210.106.7","208.14.31.5","208.40.218.136","208.64.240.163","208.102.144.58","209.8.40.177","209.51.169.86","209.114.200.129","209.147.127.221","209.160.32.149","209.162.39.130","209.172.52.78","209.192.13.248","209.213.123.40","209.221.138.34","209.221.193.39","209.234.71.30","209.237.230.67","209.242.227.89","210.6.120.185","210.185.251.180","210.224.92.251","211.30.176.235","211.69.195.72","212.41.93.152","212.42.236.140","212.60.156.94","212.101.19.178","212.108.197.46","212.112.235.78","212.112.241.137","212.112.241.159","212.112.242.21","212.112.242.159","212.118.59.154","212.168.190.8","212.202.20.191","212.202.69.196","212.202.177.250","212.202.233.2","212.204.181.70","212.227.108.114","212.246.66.59","213.9.1.108","213.17.104.91","213.22.124.81","213.23.145.142","213.29.10.25","213.39.197.221","213.39.220.159","213.41.242.132","213.42.81.102","213.47.5.234","213.67.207.73","213.84.94.72","213.84.147.225","213.84.192.84","213.93.103.10","213.100.254.174","213.114.70.246","213.114.108.245","213.134.186.198","213.140.5.244","213.146.114.96","213.161.192.240","213.176.4.250","213.182.108.12","213.189.20.167","213.203.156.22","213.203.214.130","213.203.244.67","213.207.218.193","213.213.227.54","213.218.161.250","213.220.233.230","213.228.241.143","213.239.202.232","213.239.206.174","213.239.211.148","213.239.212.133","213.239.215.48","213.246.61.26","213.251.169.20","213.253.212.106","216.12.165.46","216.27.178.157","216.55.190.121","216.110.217.24","216.137.65.86","216.139.253.42","216.194.67.53","216.195.133.27","216.220.98.32","216.231.47.120","216.239.86.243","216.254.68.35","216.254.74.90","216.254.98.195","217.10.142.173","217.10.241.26","217.11.54.81","217.20.112.191","217.20.117.92","217.20.117.129","217.20.117.240","217.20.121.40","217.28.206.143","217.85.81.245","217.93.168.26","217.96.105.139","217.115.204.25","217.121.118.110","217.149.34.124","217.160.78.171","217.160.107.206","217.160.111.190","217.160.169.57","217.160.176.49","217.160.203.26","217.172.47.18","217.172.182.26","217.172.183.219","217.173.129.76","217.190.233.143","217.198.1.130","217.207.174.83","217.226.139.70","217.228.169.37","217.230.254.76","217.232.202.113","217.236.20.103","218.2.50.181","218.3.241.173","218.21.130.42","218.69.252.86","218.87.250.249","218.89.184.160","218.91.233.126","218.102.125.161","218.189.210.17","218.193.185.188","218.199.29.20","218.252.72.8","219.73.116.71","219.77.162.202","219.94.56.232","219.95.91.8","219.105.115.156","219.130.135.26","219.138.202.151","219.144.156.50","219.159.149.138","220.132.69.56","220.157.175.94","220.233.6.198","220.233.223.105","220.234.120.202","221.137.40.119","221.137.49.215","221.137.159.160","221.188.25.27","221.196.147.113","221.201.171.80","222.77.71.70","222.90.112.189","222.183.73.216","222.188.181.63","222.209.203.33");
# Array with 1000+ known Proxy's (no Tor!)
$proxy = array("220.73.255.97","217.64.49.14","211.40.40.123","211.195.40.217","124.216.25.114","221.163.225.74","203.215.67.196","221.134.23.126","221.240.212.126","68.232.217.106","58.247.2.108","202.68.151.116","222.238.132.22","211.176.182.69","211.168.251.10","125.129.140.211","218.226.224.85","125.136.76.106","220.145.163.214","211.209.144.10","217.128.249.67","58.236.32.185","85.155.45.98","58.224.34.50","58.77.68.42","58.140.163.6","24.251.25.66","220.83.205.97","219.255.226.146","211.192.251.157","210.91.51.41","201.80.58.229","201.44.7.35","201.228.109.228","222.236.67.125","66.139.77.214","220.208.103.134","218.150.162.18823747","221.117.135.143","68.81.240.54187","84.244.170.34","129.93.68.55","86.105.123.68","207.180.182.1543847","201.82.22.239","128.59.20.227","129.24.17.69","129.237.161.193","85.124.213.243","81.13.7.184","62.245.205.70","61.46.142.24","193.251.9.73","217.8.209.37","150.101.162.2341080","80.64.87.94","81.193.87.83","217.197.168.38","221.55.23.52","202.39.243.236","58.120.108.8","218.135.54.105","211.10.143.139","193.2.248.60","86.104.80.80","72.3.245.93","213.152.139.24","8.9.25.80","203.200.175.78","68.227.103.43","218.176.136.106","211.133.117.227","221.42.142.36","62.31.242.76","219.123.211.218","220.230.177.199","125.189.139.103","203.197.87.83","60.32.7.83","59.167.195.123","203.140.250.102","217.64.48.8","212.30.82.203","200.72.133.114","218.219.151.150","203.229.235.168","69.253.47.13","203.112.204.192","81.56.76.224","202.93.36.11","130.75.152.65","83.206.210.131","219.45.108.105","213.16.133.2","66.161.123.76","69.92.232.64","85.46.232.188","60.47.1.203","69.91.59.43","85.159.88.611080","83.206.133.232","213.114.21.39","80.76.55.21","213.170.86.206","200.32.4.161","136.206.1.43","202.44.126.6","210.218.76.129","62.240.115.2","201.53.121.30","210.22.149.15000","128.143.137.249","128.4.36.12","128.10.19.52","58.73.247.201","218.125.173.24","218.209.42.100","218.48.173.51","202.146.67.238","81.8.174.31","24.214.74.1768651","65.27.194.5519","68.230.49.176","172.186.136.2","66.139.76.17","85.239.35.99","207.44.134.33","219.183.216.57","169.229.50.5","220.3.92.73","60.48.141.251","64.34.193.106","24.241.2.207","202.188.111.59","211.186.4.156","61.16.152.83","84.244.8.865123","66.194.80.184","62.42.69.0","211.199.92.172","201.80.49.193","201.53.94.141","201.36.168.184","12.214.178.1418561","66.161.123.76","24.13.89.1639395","208.58.196.1144639","59.21.209.43","58.235.94.22","220.226.146.90","220.35.100.78","219.1.142.90","218.113.228.90","201.17.189.19","165.229.133.90","84.242.241.230","61.35.116.203","61.38.105.70","202.95.165.136","201.30.49.76","69.213.61.169","58.69.204.9","201.38.194.105","213.23.8.101","61.98.212.19","222.119.78.218","80.33.26.194","222.235.48.232","194.8.47.24","62.193.164.222","59.20.160.220","221.121.196.38","218.128.1.10","216.145.16.28989","211.54.170.53","89.34.32.224","66.45.252.8265501","61.17.198.74","58.143.33.21","220.123.254.200","219.185.52.106","219.123.95.205","218.248.4.3","201.53.108.221","201.232.76.24","219.201.140.208","206.207.248.35","125.184.121.32","152.2.130.67","71.12.0.202","219.104.175.222","59.12.127.121","24.247.250.183","211.49.182.124","195.25.190.185","59.6.204.44","203.255.82.50","201.37.23.53","75.16.248.635048","203.234.238.195","202.96.1.225","61.129.159.201","210.254.114.244","218.39.27.84","200.165.79.116","151.2.168.11","59.5.127.198","220.121.141.101","218.75.110.1638","86.120.211.129","74.100.139.80","200.84.12.98","59.186.67.28","24.22.15.237","201.20.118.24","66.199.163.99","61.88.251.46","87.192.229.115","83.94.213.48","218.9.72.11681","201.83.0.110","61.32.118.243","59.26.53.133","220.88.9.205","202.188.111.45","71.94.1.197","68.39.200.265223","66.98.186.40","64.190.54.1941080","61.27.90.240","222.109.190.150","221.138.55.198","219.120.150.19","211.59.77.106","211.212.31.169","200.176.199.60","200.118.104.134","85.84.76.29","82.181.246.14","68.2.72.784006","62.56.243.212","62.84.146.99","59.4.4.84","221.150.159.240","221.12.149.1638","220.83.131.81","220.70.117.13","220.124.17.178","220.116.38.243","218.53.15.104","211.205.16.104","210.192.81.28","211.107.250.35","210.125.237.68","202.30.12.138","201.20.208.184","200.254.132.132","210.155.246.17","203.129.225.130","220.87.140.117","221.156.22.191","220.75.236.162","219.240.56.174","218.113.240.98","61.248.242.84","12.23.92.219","58.140.36.124","58.227.188.233","200.122.148.109","129.108.202.10","219.117.215.202","218.38.232.6","202.63.102.125","61.120.143.110","66.50.155.17033128","86.35.191.196","61.110.223.147","59.21.249.75","59.15.20.20","58.80.10.39","220.88.215.179","212.22.32.192","211.206.189.178","210.111.67.35","65.115.140.1476649","220.72.196.68","220.70.82.98","221.145.251.210","217.122.9.83","211.169.5.160","201.228.24.194","200.114.70.204","200.169.27.52","201.221.219.162","165.229.47.125","200.166.55.208","211.255.208.200","201.44.203.44","84.19.182.238118","72.177.152.38","128.143.137.250","200.204.176.138","218.235.217.174","125.214.234.233","201.21.148.112","62.57.246.75","213.141.186.7","24.158.140.57","201.39.187.26","89.156.251.81","201.226.91.60","200.221.97.35","163.32.106.12","210.17.238.165","69.117.237.3719378","201.81.152.155","66.135.34.11","80.35.163.52","201.24.132.196","202.158.165.82","201.57.126.130","220.224.199.82","203.232.235.100","201.17.235.149","201.17.156.22","85.88.132.138","61.135.129.123","165.98.244.34","218.224.196.154","211.200.77.4","200.217.54.90","210.113.96.18","62.101.75.14","61.236.193.6","220.117.4.213","211.110.167.202","201.55.111.27","201.236.201.51","200.176.57.150","121.143.108.207","64.34.168.29","218.178.28.48","200.164.231.28","85.28.132.29","211.201.22.45","59.29.195.52","218.126.98.124","200.96.134.35","218.152.199.223","210.112.129.160","89.156.189.101","212.32.208.220","211.244.179.17","211.117.125.251","201.21.14.42","69.46.0.685566","66.17.137.96","201.87.4.86","125.133.56.37","83.93.248.200","62.216.122.87","201.20.117.157","201.53.103.55","213.146.108.155","201.221.142.120","221.93.16.134","218.124.172.91","61.241.249.25","201.17.171.58","84.205.33.62","61.249.250.135","219.64.85.115","201.49.4.205","212.165.130.14","64.34.166.88","221.153.56.253","201.6.117.205","201.228.60.198","201.17.237.107","81.86.37.27","219.23.20.207","201.37.214.212","194.80.38.242","87.192.229.115","221.184.250.218","220.151.2.72","218.216.213.77","218.115.184.43","201.81.22.124","201.18.140.80","201.17.211.56","200.31.137.58","200.21.234.166","128.232.103.203","161.114.22.70","83.223.136.45","85.48.208.47","61.26.185.234","59.77.0.167","58.225.164.26","222.233.155.36","220.11.185.45","211.107.105.224","201.80.54.197","69.138.223.1066795","201.80.54.106","200.169.27.22","70.245.244.1254567","83.97.24.198","194.27.48.254","148.209.1.40","200.71.62.80","24.210.42.1695463","86.105.198.29","62.197.126.10","168.188.189.175","201.80.4.236","218.152.81.48","201.23.217.14","200.21.173.30","87.101.240.8","59.93.105.114","146.164.96.156","128.111.52.62","128.111.52.62","58.74.139.22","148.235.56.75","211.51.217.95","221.85.217.59","201.37.216.143","68.110.103.1577195","80.237.140.233","208.39.144.61","219.254.55.244","210.64.216.187","69.242.157.1408557","58.158.24.140","211.237.215.160","68.99.193.69","221.164.198.223","220.92.96.66","217.220.255.215","67.43.164.130","211.172.214.129","201.17.174.183","203.165.229.29","59.15.193.89","218.55.165.145","201.80.4.72","221.142.158.148","200.127.0.223","220.119.70.42","218.238.39.80","200.148.212.154","131.247.2.242","140.109.17.180","58.76.166.177","220.69.221.66","219.206.196.134","218.51.59.177","203.145.81.23","140.109.40.253","221.162.130.155","144.122.170.46","61.35.225.92","201.80.37.183","67.168.42.953824","81.169.140.225","71.40.98.18","201.6.24.70","61.72.241.27","210.212.216.16316412","58.12.27.197","211.7.20.1733129","201.52.48.69","80.237.140.233","68.9.242.1463457","209.221.193.398118","218.39.211.229","200.176.61.94","201.17.230.179","201.31.10.35","84.244.1.79","201.81.27.227","201.37.75.63","201.37.23.166","201.53.7.7","24.75.91.1829122","62.233.146.1781","169.229.50.3","129.82.12.187","221.13.66.161","201.17.187.105","200.220.220.233","83.143.180.129","59.13.220.92","221.150.81.57","220.119.158.14","212.170.13.18100","211.179.82.206","211.200.181.174","211.187.238.163","210.211.255.39","200.188.241.97","12.106.100.41","210.211.164.223","202.63.170.157","201.54.163.158","201.17.255.47","200.21.157.162","58.142.85.199","203.253.80.1171167","218.52.139.120","222.177.88.86","211.210.34.253","152.2.130.66","201.235.149.171","201.31.195.183","201.221.140.150","201.17.231.110","200.21.245.222","201.17.202.111","195.8.26.38","221.242.119.61","201.31.102.130","200.245.55.86","201.6.102.199","201.31.13.74","201.37.214.107","141.24.33.162","193.151.42.86","211.37.37.195","68.199.83.207","128.112.139.96","80.64.207.220","84.172.141.108","218.45.247.210","62.179.33.226","218.152.81.59","211.200.65.166","210.182.48.208","218.248.20.20","86.124.42.39","212.179.55.115","85.187.15.249","212.126.221.9","218.234.101.9","211.118.206.101","194.8.192.4","221.243.236.206","210.91.44.222","24.221.191.219","218.150.111.1104480","203.255.12.79","83.208.195.10","211.109.232.232","165.230.49.114","24.64.177.2146649","210.183.216.245","201.31.11.69","221.114.219.12","220.132.117.208","221.153.78.202","194.230.53.179","222.177.88.87","192.17.239.252","218.86.126.226","201.52.155.232","222.239.127.146","221.165.193.67","155.98.35.3","210.67.128.252","211.176.9.184","201.20.102.18","201.21.102.148","201.18.140.196","201.17.252.66","200.161.192.15","58.140.210.241","86.101.46.117","201.252.89.188","210.202.79.14480","219.196.208.20","220.77.103.191","61.34.18.134","59.1.205.131","59.19.132.153","220.121.145.84","61.101.91.103","222.235.205.199","221.152.208.242","198.163.152.229","211.195.41.180","219.64.84.27","219.49.198.6","218.52.39.194","218.216.167.169","200.166.103.43","69.11.157.46","128.10.19.52","201.226.251.90","59.4.66.178","222.110.5.166","128.112.139.97","192.41.135.219","66.167.100.596649","202.104.139.250","209.203.227.139443","83.14.191.226","202.188.111.26","200.179.206.102","80.237.206.938118","68.12.191.25421350","68.96.167.58","58.151.7.220","194.80.38.242","211.207.125.180","138.23.204.232","200.250.72.35","200.118.113.13","75.16.226.785048","70.113.205.896015","61.36.79.149","61.144.222.49","80.237.140.233","210.59.146.1951081","131.179.112.70","131.247.2.242","196.45.34.165","222.105.163.146","200.67.31.247","80.237.140.23308","128.134.137.23","165.194.121.227","169.229.50.8","218.132.68.21","125.135.108.249","128.112.139.110","59.21.61.116","220.88.181.88","80.237.140.233","24.119.71.176","211.51.162.44","222.108.188.36","201.63.209.50","219.138.199.17882","221.157.133.195","61.38.245.133","61.33.26.25","222.236.127.59","222.119.58.85","220.77.98.160","203.144.144.164","59.9.40.141","222.232.92.138","58.72.8.38","220.64.190.150","210.123.182.8","212.0.224.246","84.17.0.74","201.221.199.135","83.145.217.211","211.212.176.62","221.164.198.82","58.232.144.13","59.22.182.122","201.80.28.177","200.150.132.53","200.75.61.138","219.159.73.2018","69.73.176.653737","82.236.152.79","201.37.163.5","86.35.43.85","80.237.140.233","222.234.87.160","211.180.163.130","203.253.85.46","210.101.5.86","201.80.46.143","201.52.26.216","151.2.171.205","124.50.35.43","200.114.202.196","217.128.25.2","82.78.125.228","217.112.37.9611417","203.255.15.101","202.188.111.14","221.242.46.22","203.117.141.14665501","211.210.34.253","220.123.230.200","221.162.76.100","24.42.35.239","222.114.82.20","59.30.145.132","218.238.214.149","210.92.30.145","201.81.137.29","212.74.231.179","171.66.3.181","222.116.207.8","211.197.137.43","201.55.107.149","200.221.9.57","205.150.73.3","219.8.80.73","128.232.103.203","74.132.170.6721922","221.245.92.221","140.109.17.180","64.15.146.170","222.111.18.16","169.229.50.8","58.26.160.31","213.175.76.196","59.16.218.134","80.237.140.23301","59.42.210.176","62.236.162.11","80.237.140.23381","128.10.19.52","201.38.143.51","211.55.159.36","211.232.206.85","213.30.141.186","59.45.30.228","83.173.65.59","222.237.107.107","59.1.212.45","211.194.74.87","128.112.139.97","220.125.76.243","211.205.87.103","125.186.178.10","124.50.69.21","200.41.59.95","201.20.114.84","194.7.54.1","69.60.119.162","80.237.140.2339994","81.183.225.228","58.93.58.165","80.237.42.232","195.24.42.99","148.235.96.114","192.41.135.218","222.117.194.25","222.235.106.191","222.122.158.24313794","221.47.147.16","221.146.71.30","142.165.59.170","59.5.2.166","192.41.135.218","128.114.63.16","201.72.186.222","200.49.179.50","201.17.146.34","128.112.139.110","192.41.135.218","130.104.72.201","66.98.168.100","58.232.96.238","201.52.228.165","58.74.57.12","58.76.152.231","61.78.149.253","221.150.194.114","220.73.57.213","203.144.144.164","82.103.135.7","210.245.0.171","83.237.6.127","222.112.19.180","221.138.181.216","211.55.66.97","221.251.114.45","136.145.115.194","136.145.115.194","147.102.3.101","80.237.140.2333382","198.163.152.229","217.7.101.190","211.155.133.2","220.29.65.32","138.100.12.149","200.179.190.126","128.195.25.102","201.20.108.47","143.248.139.168","221.253.30.148","220.24.90.20","205.250.144.164","211.211.124.94","219.56.96.22","203.140.180.223","82.103.131.3100","64.81.100.2088118","222.132.76.383312","219.142.40.82","128.112.139.110","61.32.118.227","61.121.221.188","80.237.140.23300","211.117.137.52","203.145.81.23","24.244.147.200","201.6.195.53","203.185.129.49","59.23.181.106","210.114.174.964480","211.205.167.121","24.244.130.222","221.154.140.239","220.83.140.200","222.117.246.57","220.86.186.40","210.91.183.97","222.96.239.9","82.103.131.31","61.129.51.1428","59.4.140.84","210.23.222.18","203.162.89.6100","222.103.230.170","211.222.66.226","222.235.156.179","222.107.191.107","222.100.252.16","219.238.187.32780","59.1.50.148","198.163.152.229","61.157.96.36","211.234.93.1468","82.103.131.31","200.209.168.168","194.80.38.242","200.87.168.213","219.240.36.1744480","218.155.197.199","221.231.139.168","201.82.67.35","219.240.57.27","211.180.116.205","201.31.15.253","200.204.149.110","165.230.49.115","128.163.142.21","202.82.119.17","200.68.73.201","195.116.60.82","59.13.211.147","200.95.33.110","128.214.112.92","211.215.17.734480","83.208.168.241","128.238.88.64","222.108.238.236","169.229.50.12","169.229.50.12","86.35.34.75","68.53.58.1457594","220.86.213.229","193.251.82.133","212.201.44.74","221.254.206.226","124.50.89.17","84.120.29.203","72.8.69.6726122","88.191.33.1698118","59.24.118.10","61.106.75.79","59.12.119.234","218.153.90.84","128.114.63.16","211.35.59.97","202.96.17.218","200.89.127.185","201.81.137.169","201.52.180.84","201.226.84.11","200.71.62.100","200.107.5.55","169.229.50.15","201.155.170.232","141.213.4.202","138.23.204.232","140.115.117.143","130.49.221.41","129.137.253.253","129.108.202.10","129.82.12.187","216.165.109.82","128.31.1.16","129.82.12.188","218.62.81.78","211.115.230.93","61.41.201.98","58.143.40.114","58.142.136.111","218.115.10.48","210.101.35.9","80.237.140.233","203.129.199.146","62.168.73.109","131.247.2.242","211.195.220.53","211.37.123.210","220.92.226.33","59.187.123.54","218.122.240.100","128.112.139.97","211.178.7.70","212.248.191.205","192.17.239.250","141.213.4.201","160.36.57.173","169.229.50.15","129.237.123.251","128.111.52.61","155.98.35.2","209.203.227.139","222.119.76.180","211.194.18.60","64.89.16.71234","169.229.50.13","35.9.27.26","169.229.50.15","128.112.139.96","61.85.181.132","218.153.39.15","81.169.183.122","61.153.148.18000","218.75.87.378","138.23.204.232","59.18.143.176","61.17.191.79","201.53.88.189","200.42.227.221","125.18.33.136","128.232.103.202","155.98.35.2","82.79.139.6","192.41.135.219","61.246.251.35","59.92.110.85","219.248.161.10","155.98.35.2","195.116.60.82","210.213.113.42","64.114.213.251","155.98.35.2","125.188.149.189","35.9.27.26","165.91.83.23","169.229.50.9","169.229.50.9","212.116.241.90","58.150.48.18","220.227.97.146","219.153.41.458","211.50.32.190","211.177.119.175","200.206.132.140","213.42.2.21","200.207.117.98","58.224.0.204","192.33.90.197","61.78.65.14600","202.159.112.253","82.145.215.19","220.191.169.46","210.114.183.194","203.3.109.194","61.248.232.234","211.47.183.179","122.254.158.104","209.203.227.139","141.213.4.201","203.81.136.155","58.74.159.14","128.112.139.71","125.184.103.183","201.81.132.211","220.68.74.149","82.76.214.105","80.249.73.99","128.112.139.72","130.104.72.200","219.153.4.988","84.244.11.128","218.209.38.89","125.182.192.104","125.14.90.252","192.41.135.219","195.116.60.82","125.137.79.168","125.132.96.58","128.114.63.16","128.220.247.28","129.41.250.20","128.31.1.15","141.213.4.201","156.56.103.62","192.33.90.197","59.11.10.229","210.217.141.2","128.112.139.96","81.208.95.27","129.237.123.250","169.229.50.9","169.229.50.8","141.213.4.201","128.112.139.73","129.170.214.191","124.125.126.13","202.154.80.226","128.197.13.31","204.249.97.5","169.229.50.15","169.229.50.12","169.229.50.14","169.229.50.16","12.32.77.98","200.55.201.135","211.119.64.220","211.199.105.174","211.62.70.97","211.52.131.200","211.40.211.182","211.226.124.209","211.33.201.130","211.227.190.159","211.178.68.167","211.168.194.31","211.162.62.161","210.238.193.210","220.125.190.39","219.240.79.62","219.240.12.173","218.48.28.203","218.28.14.73","61.96.144.180","218.241.67.358","218.18.101.978","206.82.130.210","201.64.57.177","217.75.194.118","35.9.27.26","165.91.83.23","203.142.177.164","202.144.76.11","200.72.204.37","200.152.60.138","211.107.197.231","202.106.192.134","165.229.205.91","168.187.0.35","128.112.139.96","194.165.130.93","128.134.202.175","125.182.104.63","148.235.86.114","128.119.247.211","165.91.83.23","61.246.202.98");

# Logic

if(in_array($locIP, $nodes)) {
   $TorIP = $locIP . ":true";
   } else {
   $TorIP = ":false";
   }
   
if(in_array($locIP, $proxy)) {
   $ProxyIP = $locIP . ":true";
   } else {
   $ProxyIP = ":false";
   }
   
?>

<html>
<head>
<script>

function XHR(url) {
    var ro;
	var browser = navigator.appName;
    if(browser == "Microsoft Internet Explorer"){
    ro = new ActiveXObject("Microsoft.XMLHTTP");
	ro.open('get',url,true);
    ro.send(null);
	
    } else {
    ro = new XMLHttpRequest();
	ro.open('get',url,true);
    ro.send(null);
    }

  }

function IP()
{ 
   try {
   var sock = new java.net.Socket();
   sock.bind(new java.net.InetSocketAddress('0.0.0.0', 0));
   sock.connect(new java.net.InetSocketAddress(document.domain, (!document.location.port)?80:document.location.port));
   hostname = sock.getLocalAddress().getHostName();
   address = sock.getLocalAddress().getHostAddress();
   return address;
   } catch(e) { address = "0.0.0.0"; }
} 
</script>
</head>
<body>
<script>
/* Just a XHR to a PHP file which will write all the info away */
XHR('yo.php?localIP=' + '<?=$locIP;?>' + '&tor=' + '<?=$TorIP;?>' + '&proxy=' + '<?=$ProxyIP;?>' + '&internalIP='+IP());
/* Dump result on screen */
document.write('somelog.php?localIP=' + '<?=$locIP;?>' + '&tor=' + '<?=$TorIP;?>' + '&proxy=' + '<?=$ProxyIP;?>' + '&internalIP='+IP());
</script>
</body>
</html>