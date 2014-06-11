#!/usr/bin/python3
# Use this for hourly cron: 0 * * * * /srv/http/pl4ygr0und/vera/temper/temper.py
try:
    from lxml import etree
    from subprocess import check_output
    from sys import stdout
except:
    print("Import failed")

xml_file = '/srv/http/pl4ygr0und/vera/webinterface/temperature.xml'
doc = etree.parse(xml_file)
root = doc.getroot()

tempercall = str(check_output(["/srv/http/pl4ygr0und/vera/temper/temper"]))
temperdate = tempercall[2:12]
tempertime = tempercall[16:21]
tempertemp = tempercall[22:-1]

new_node_date = etree.Element("date")
new_node_date.text = temperdate
new_node_time = etree.Element("time")
new_node_time.text = tempertime
new_node_temp = etree.Element("temperature")
new_node_temp.text = tempertemp

new_id = len(root) + 1
new_node = etree.Element("node", id=str(new_id))
new_node.append(new_node_date)
new_node.append(new_node_time)
new_node.append(new_node_temp)

root.append(new_node)

outFile = open(xml_file, 'wb')
doc.write(outFile)
