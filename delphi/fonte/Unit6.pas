unit Unit6;

interface

uses
  Windows, Messages, SysUtils, Variants, Classes, Graphics, Controls, Forms,
  Dialogs, StdCtrls;

type
  TForm6 = class(TForm)
    GroupBox1: TGroupBox;
    ComboBox1: TComboBox;
    ComboBox2: TComboBox;
    ComboBox3: TComboBox;
    ComboBox4: TComboBox;
    ComboBox5: TComboBox;
    ComboBox6: TComboBox;
    Button1: TButton;
    procedure Button1Click(Sender: TObject);
    procedure FormShow(Sender: TObject);
    procedure ComboBox1Change(Sender: TObject);
    procedure ComboBox2Change(Sender: TObject);
    procedure ComboBox3Change(Sender: TObject);
    procedure ComboBox4Change(Sender: TObject);
  private
    { Private declarations }
  public
    { Public declarations }
  end;

var
  Form6: TForm6;

implementation

uses Urpg, Urpg2, uitem;

{$R *.dfm}

procedure TForm6.Button1Click(Sender: TObject);
begin
form1.ComboBox1.Itemindex:= form6.ComboBox1.Itemindex;
form1.ComboBox2.Itemindex:= form6.ComboBox2.Itemindex;
form1.ComboBox3.Itemindex:= form6.ComboBox3.Itemindex;
form1.ComboBox4.Itemindex:= form6.ComboBox4.Itemindex;
form2.ComboBox5.Itemindex:= form6.ComboBox5.Itemindex;
form2.ComboBox6.Itemindex:= form6.ComboBox6.Itemindex;
showmessage('Itens trocados...');
form6.Close;
end;

procedure TForm6.FormShow(Sender: TObject);
begin
form6.ComboBox1.Items:= form1.ComboBox1.Items;
form6.ComboBox2.Items:= form1.ComboBox2.Items;
form6.ComboBox3.Items:= form1.ComboBox3.Items;
form6.ComboBox4.Items:= form1.ComboBox4.Items;
form6.ComboBox5.Items:= form2.ComboBox5.Items;
form6.ComboBox6.Items:= form2.ComboBox6.Items;
//
form6.ComboBox1.Itemindex:= form1.ComboBox1.Itemindex;
form6.ComboBox2.Itemindex:= form1.ComboBox2.Itemindex;
form6.ComboBox3.Itemindex:= form1.ComboBox3.Itemindex;
form6.ComboBox4.Itemindex:= form1.ComboBox4.Itemindex;
form6.ComboBox5.Itemindex:= form2.ComboBox5.Itemindex;
form6.ComboBox6.Itemindex:= form2.ComboBox6.Itemindex;
end;

procedure TForm6.ComboBox1Change(Sender: TObject);
begin
case combobox1.ItemIndex of
0:begin
  end;
1:begin
        if itcomp[2] = true then
                begin
                end
        else
                begin
                showmessage('Item indisponível no momento!');
                combobox1.ItemIndex:= -1;
                end;
  end;
2:begin
        if itcomp[3] = true then
                begin
                end
        else
                begin
                showmessage('Item indisponível no momento!');
                combobox1.ItemIndex:= -1;
                end;
  end;
3:begin
        if itcomp[4] = true then
                begin
                end
        else
                begin
                showmessage('Item indisponível no momento!');
                combobox1.ItemIndex:= -1;
                end;
  end;
end;
end;


procedure TForm6.ComboBox2Change(Sender: TObject);
begin
case combobox2.ItemIndex of
0:begin
        if form1.radiogroup1.ItemIndex = 1 then
                begin
                showmessage('Item indisponível no momento!');
                combobox2.ItemIndex:= -1;
                end;
        if form1.radiogroup1.ItemIndex = 3 then
                begin
                showmessage('Item indisponível no momento!');
                combobox2.ItemIndex:= -1;
                end;
  end;
1:begin
        if form1.radiogroup1.ItemIndex = 2 then
        else
                begin
                        showmessage('Item indisponível no momento!');
                        combobox2.ItemIndex:= -1;
                end;
  end;
2:begin
        if form1.radiogroup1.ItemIndex = 3 then
                begin
                        showmessage('Item indisponível no momento!');
                        combobox2.ItemIndex:= -1;
                end;
        if form1.radiogroup1.ItemIndex = 0 then
                begin
                        showmessage('Item indisponível no momento!');
                        combobox2.ItemIndex:= -1;
                end;
  end;
3:begin
        if form1.radiogroup1.ItemIndex = 1 then
                begin
                        showmessage('Item indisponível no momento!');
                        combobox2.ItemIndex:= -1;
                end;
        if form1.radiogroup1.ItemIndex = 2 then
                begin
                        showmessage('Item indisponível no momento!');
                        combobox2.ItemIndex:= -1;
                end;
  end;
4:begin
        if form1.radiogroup1.ItemIndex = 1 then
                begin
                        showmessage('Item indisponível no momento!');
                        combobox2.ItemIndex:= -1;
                end;
        if form1.radiogroup1.ItemIndex = 2 then
                begin
                        showmessage('Item indisponível no momento!');
                        combobox2.ItemIndex:= -1;
                end;
  end;
5:begin
  end;
6:begin
        if form1.radiogroup1.ItemIndex = 1 then
                begin
                        showmessage('Item indisponível no momento!');
                        combobox2.ItemIndex:= -1;
                end;
        if form1.radiogroup1.ItemIndex = 3 then
                begin
                        showmessage('Item indisponível no momento!');
                        combobox2.ItemIndex:= -1;
                end;
  end;
end;
end;

procedure TForm6.ComboBox3Change(Sender: TObject);
begin
case combobox3.ItemIndex of
0:begin
  end;
1:begin
        if itcomp[13] = true then
                begin
                end
        else
                begin
                showmessage('Item indisponível no momento!');
                combobox3.ItemIndex:= -1;
                end;
  end;
2:begin
        if itcomp[14] = true then
                begin
                end
        else
                begin
                showmessage('Item indisponível no momento!');
                combobox3.ItemIndex:= -1;
                end;
  end;
3:begin
        if itcomp[15] = true then
                begin
                end
        else
                begin
                showmessage('Item indisponível no momento!');
                combobox3.ItemIndex:= -1;
                end;
  end;
4:begin
        if itcomp[16] = true then
                begin
                end
        else
                begin
                showmessage('Item indisponível no momento!');
                combobox3.ItemIndex:= -1;
                end;
  end;
end;
end;

procedure TForm6.ComboBox4Change(Sender: TObject);
begin
case combobox4.ItemIndex of
0:begin
  end;
1:begin
        if itcomp[18] = true then
                begin
                end
        else
                begin
                showmessage('Item indisponível no momento!');
                combobox4.ItemIndex:= -1;
                end;
  end;
2:begin
        if itcomp[19] = true then
                begin
                end
        else
                begin
                showmessage('Item indisponível no momento!');
                combobox4.ItemIndex:= -1;
                end;
  end;
3:begin
        if itcomp[20] = true then
                begin
                end
        else
                begin
                showmessage('Item indisponível no momento!');
                combobox4.ItemIndex:= -1;
                end;
  end;
end;
end;

end.
