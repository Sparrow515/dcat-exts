echo "start change owner"
sudo chown -R $USER:$USER .
echo "finish change owner & start change directoty permission"
sudo find . -type d -exec chmod 775 {} \;
echo "finish change directoty permission & start change file permission"
sudo find . -type f -exec chmod 664 {} \;
echo "all finished"