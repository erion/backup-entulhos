unit ubloco;

interface

uses
  Windows, Messages, SysUtils, Variants, Classes, Graphics, Controls, Forms,
  Dialogs, Menus, StdCtrls;

type
  TForm1 = class(TForm)
    Memo1: TMemo;
    MainMenu1: TMainMenu;
    Arquivo1: TMenuItem;
    Editar1: TMenuItem;
    Formatar1: TMenuItem;
    Exibir1: TMenuItem;
    Ajuda1: TMenuItem;
    Novo1: TMenuItem;
    Abrir1: TMenuItem;
    Salvar1: TMenuItem;
    Salvarcomo1: TMenuItem;
    Configurarpgina1: TMenuItem;
    Imprimir1: TMenuItem;
    extBridge1: TMenuItem;
    Sair1: TMenuItem;
    Desfazer1: TMenuItem;
    Recortar1: TMenuItem;
    Copiar1: TMenuItem;
    Colar1: TMenuItem;
    Excluir1: TMenuItem;
    Localizar1: TMenuItem;
    Localizarprxima1: TMenuItem;
    Substituir1: TMenuItem;
    Irpara1: TMenuItem;
    Selecionartudo1: TMenuItem;
    HoraData1: TMenuItem;
    Quebraautomticadelinhas1: TMenuItem;
    Fonte1: TMenuItem;
    BarradeStatus1: TMenuItem;
    SobreBlocoFtido1: TMenuItem;
    N1: TMenuItem;
    N2: TMenuItem;
    N3: TMenuItem;
    N4: TMenuItem;
    N5: TMenuItem;
    procedure Quebraautomticadelinhas1Click(Sender: TObject);
    procedure Fonte1Click(Sender: TObject);
  private
    { Private declarations }
  public
    { Public declarations }
  end;

var
  Form1: TForm1;

implementation

uses Ufonte;

{$R *.dfm}

procedure TForm1.Quebraautomticadelinhas1Click(Sender: TObject);
begin
if form1.Quebraautomticadelinhas1.Checked = false then
form1.Quebraautomticadelinhas1.Checked:=true
else
form1.Quebraautomticadelinhas1.Checked:= false;
end;

procedure TForm1.Fonte1Click(Sender: TObject);
begin
form2.show;
end;

end.
