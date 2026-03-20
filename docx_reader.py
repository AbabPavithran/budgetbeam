import zipfile
import xml.etree.ElementTree as ET
def get_docx_text(path):
	document = zipfile.ZipFile(path)
	xml_content = document.read('word/document.xml')
	document.close()
	tree = ET.fromstring(xml_content)
	ns = {'w': 'http://schemas.openxmlformats.org/wordprocessingml/2006/main'}
	text = []
	for p in tree.findall('.//w:p', ns):
		para_text = ''
		for r in p.findall('.//w:r', ns):
			t_node = r.find('./w:t', ns)
			if t_node is not None and t_node.text:
				para_text += t_node.text
		text.append(para_text)
	return '\n'.join(text)

content = get_docx_text('Mantra_FSD_Report__6_ (1).docx')
with open('mantra_report_dump.txt', 'w', encoding='utf-8') as f:
	f.write(content)