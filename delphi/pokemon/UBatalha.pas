unit UBatalha;

interface

uses
  Windows, Messages, SysUtils, Variants, Classes, Graphics, Controls, Forms,
  Dialogs, ExtCtrls, jpeg, StdCtrls;

type
  TfrmBatalha = class(TForm)
    imgPokemon: TImage;
    imgInimigo: TImage;
    imgFundo: TImage;
    Timer1: TTimer;
    btnAtacar: TButton;
    btnItem: TButton;
    btnFugir: TButton;
    btnCapturar: TButton;
    btnConfirmarAtaque: TButton;
    pnlAtaques: TPanel;
    rbAtaque1: TRadioButton;
    rbAtaque2: TRadioButton;
    rbAtaque3: TRadioButton;
    rbAtaque4: TRadioButton;
    procedure FormShow(Sender: TObject);
    procedure Timer1Timer(Sender: TObject);
    procedure btnAtacarClick(Sender: TObject);
    procedure btnConfirmarAtaqueClick(Sender: TObject);
    procedure btnFugirClick(Sender: TObject);
  private
    { Private declarations }
    procedure SetBotoesAtivados(ativado:boolean);
  public
    class procedure Create2(nmrPokInimigo,nmrPok:integer; Owner:TComponent);
    { Public declarations }
  end;

var
  frmBatalha: TfrmBatalha;

implementation

{$R *.dfm}

{************************************************************
 *************** Minhas procedures e functions ************** 
 ************************************************************}

class procedure TfrmBatalha.Create2(nmrPokInimigo,nmrPok:integer; Owner:TComponent);
begin
//  frmBatalha := TfrmBatalha.Create(Owner);

  if nmrPokInimigo <> 0 then  // depois pode sair
  begin
    case StrLen(PChar(IntToStr(nmrPokInimigo))) of
      1: frmBatalha.imgInimigo.Picture.LoadFromFile('imagens/p00' + IntToStr(nmrPokInimigo) + '.bmp');
      2: frmBatalha.imgInimigo.Picture.LoadFromFile('imagens/p0' + IntToStr(nmrPokInimigo) + '.bmp');
      3: frmBatalha.imgInimigo.Picture.LoadFromFile('imagens/p' + IntToStr(nmrPokInimigo) + '.bmp');
    end;
  end;

  if nmrPok <> 0 then // depois pode sair
  begin
    case StrLen(PChar(IntToStr(nmrPok))) of
      1: frmBatalha.imgPokemon.Picture.LoadFromFile('imagens/b00' + IntToStr(nmrPok) + '.bmp');
      2: frmBatalha.imgPokemon.Picture.LoadFromFile('imagens/b0' + IntToStr(nmrPok) + '.bmp');
      3: frmBatalha.imgPokemon.Picture.LoadFromFile('imagens/b' + IntToStr(nmrPok) + '.bmp');
    end;
  end;
end;

procedure TfrmBatalha.SetBotoesAtivados(ativado: boolean);
begin
  btnAtacar.Enabled := ativado;
  btnItem.Enabled := ativado;
  btnFugir.Enabled := ativado;
  btnCapturar.Enabled := ativado;
  btnConfirmarAtaque.Visible := not ativado;
end;

{************************************************************
 *************** Fim das procedures e functions *************
 ************************************************************}

procedure TfrmBatalha.FormShow(Sender: TObject);
begin
  //apenas para poder enchergar as imagens em tempo de projeto
  imgPokemon.AutoSize := True;
  imgInimigo.AutoSize := True;

  Randomize;
end;

procedure TfrmBatalha.Timer1Timer(Sender: TObject);
var a,b:integer;
begin
  a := random(68);
  b := random(151);
  frmBatalha.Create2(a,b,Self);
end;

procedure TfrmBatalha.btnAtacarClick(Sender: TObject);
begin
  SetBotoesAtivados(False);
  pnlAtaques.Visible := True;
end;

procedure TfrmBatalha.btnConfirmarAtaqueClick(Sender: TObject);
begin
  SetBotoesAtivados(True);
  pnlAtaques.Visible := False;
end;

procedure TfrmBatalha.btnFugirClick(Sender: TObject);
begin
  Application.Terminate;
end;

end.
